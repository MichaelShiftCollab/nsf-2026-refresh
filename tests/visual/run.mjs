/* eslint-disable no-console */
// Screenshot comparison: captures each pages.json entry at each width with Playwright,
// compares it to tests/visual/mockups/<mockup>-<width>.png with pixelmatch, and writes
// screenshots, diffs, results.json and report.html to tests/visual/results, or to
// the folder in VISUAL_RESULTS so parallel runs do not clear each other's results.
//
// Usage: npm run test:visual [-- --grep <text>] [--base-url <url>]
import fs from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import { chromium } from 'playwright';
import { PNG } from 'pngjs';
import pixelmatch from 'pixelmatch';

const dir = path.dirname( fileURLToPath( import.meta.url ) );
const resultsDir = process.env.VISUAL_RESULTS
	? path.resolve( process.env.VISUAL_RESULTS )
	: path.join( dir, 'results' );
const DEFAULT_THRESHOLD = 10; // percent mismatch allowed
const DEFAULT_HEIGHT_TOLERANCE = 15; // percent of mockup height the page may differ by

const args = process.argv.slice( 2 );
const arg = ( name ) => {
	const i = args.indexOf( name );
	return i === -1 ? undefined : args[ i + 1 ];
};
const grep = arg( '--grep' )?.toLowerCase();
const baseUrl = (
	arg( '--base-url' ) ||
	process.env.BASE_URL ||
	'http://localhost:8080'
).replace( /\/$/, '' );

const wpUser = process.env.WP_USER || 'admin';
const wpPass = process.env.WP_PASS || 'admin';

// Logs in for entries with "auth": true (private pages). The admin bar is hidden before capture.
async function logIn( page, url ) {
	await page.goto(
		`${ baseUrl }/wp-login.php?redirect_to=${ encodeURIComponent( url ) }`
	);
	await page.fill( '#user_login', wpUser );
	await page.fill( '#user_pass', wpPass );
	await Promise.all( [
		page.waitForURL( url, { timeout: 60000 } ),
		page.click( '#wp-submit' ),
	] );
}

const pages = JSON.parse(
	await fs.readFile( path.join( dir, 'pages.json' ), 'utf8' )
).filter(
	( p ) =>
		! grep ||
		[ p.name, p.group ].some( ( v ) => v?.toLowerCase().includes( grep ) )
);
if ( ! pages.length ) {
	console.error(
		grep
			? `No pages.json entries match "${ grep }".`
			: 'pages.json is empty.'
	);
	process.exit( 1 );
}

await fs.rm( resultsDir, { recursive: true, force: true } );
await fs.mkdir( resultsDir, { recursive: true } );

const readPng = async ( file ) => PNG.sync.read( await fs.readFile( file ) );

// Copies the top-left w x h region of a PNG.
const crop = ( png, w, h ) => {
	const out = new PNG( { width: w, height: h } );
	PNG.bitblt( png, out, 0, 0, w, h, 0, 0 );
	return out;
};

// Fills each box with one flat color so the region compares as identical.
const paint = ( png, boxes ) => {
	for ( const b of boxes ) {
		const x0 = Math.max( 0, Math.floor( b.x ) );
		const y0 = Math.max( 0, Math.floor( b.y ) );
		const x1 = Math.min( png.width, Math.ceil( b.x + b.width ) );
		const y1 = Math.min( png.height, Math.ceil( b.y + b.height ) );
		for ( let y = y0; y < y1; y++ ) {
			for ( let x = x0; x < x1; x++ ) {
				const i = ( y * png.width + x ) * 4;
				png.data[ i ] = 255;
				png.data[ i + 1 ] = 0;
				png.data[ i + 2 ] = 255;
				png.data[ i + 3 ] = 255;
			}
		}
	}
};

// Boxes of the "ignore" selectors (e.g. photos that differ from the mockup's),
// relative to the captured element or page.
async function ignoreBoxes( page, selector, ignore = [] ) {
	if ( ! ignore.length ) {
		return [];
	}
	return page.evaluate(
		( [ base, selectors ] ) => {
			const docRect = ( el ) => {
				const r = el.getBoundingClientRect();
				return {
					x: r.x + window.scrollX,
					y: r.y + window.scrollY,
					width: r.width,
					height: r.height,
				};
			};
			const origin = base
				? docRect( document.querySelector( base ) )
				: { x: 0, y: 0 };
			return selectors.flatMap( ( sel ) =>
				[ ...document.querySelectorAll( sel ) ].map( ( el ) => {
					const r = docRect( el );
					return {
						x: r.x - origin.x,
						y: r.y - origin.y,
						width: r.width,
						height: r.height,
					};
				} )
			);
		},
		[ selector, ignore ]
	);
}

async function runActions( page, actions = [] ) {
	for ( const a of actions ) {
		if ( a.click ) {
			await page.click( a.click );
		}
		if ( a.hover ) {
			await page.hover( a.hover );
		}
		if ( a.select ) {
			await page.selectOption( a.select, a.value );
		}
		if ( a.check ) {
			await page.check( a.check );
		}
		if ( a.fill ) {
			await page.fill( a.fill, a.value ?? '' );
		}
		if ( a.scroll !== undefined ) {
			await page.evaluate( ( y ) => window.scrollTo( 0, y ), a.scroll );
		}
		if ( a.waitFor ) {
			await page.waitForSelector( a.waitFor );
		}
		if ( a.wait ) {
			await page.waitForTimeout( a.wait );
		}
	}
}

const browser = await chromium.launch();
const results = [];

for ( const entry of pages ) {
	for ( const width of entry.widths || [ 1440, 781, 600 ] ) {
		const id = `${ entry.name }-${ width }`;
		const mockupFile = path.join(
			dir,
			'mockups',
			`${ entry.mockup || entry.name }-${ width }.png`
		);
		const threshold = entry.threshold ?? DEFAULT_THRESHOLD;
		const result = {
			id,
			name: entry.name,
			width,
			url: baseUrl + entry.url,
			threshold,
		};
		results.push( result );

		const hasMockup = await fs.access( mockupFile ).then(
			() => true,
			() => false
		);
		if ( ! hasMockup ) {
			result.status = 'no-mockup';
			continue;
		}

		const context = await browser.newContext( {
			viewport: { width, height: 800 },
			reducedMotion: 'reduce',
		} );
		const page = await context.newPage();
		try {
			if ( entry.auth ) {
				await logIn( page, result.url );
			}
			const response = await page.goto( result.url, {
				waitUntil: 'networkidle',
			} );
			result.httpStatus = response?.status();
			await page.addStyleTag( {
				content:
					'#wpadminbar{display:none!important}html{margin-top:0!important}',
			} );
			await page.evaluate( () => document.fonts.ready );
			// Park the pointer so no hover state leaks in from the login click.
			await page.mouse.move( 0, 0 );
			await runActions( page, entry.actions );
			const shotFile = path.join( resultsDir, `${ id }.png` );
			const options = {
				path: shotFile,
				animations: 'disabled',
				caret: 'hide',
			};
			if ( entry.selector ) {
				await page
					.locator( entry.selector )
					.first()
					.screenshot( options );
			} else {
				await page.screenshot( {
					...options,
					fullPage: entry.fullPage ?? true,
				} );
			}

			const boxes = await ignoreBoxes(
				page,
				entry.selector,
				entry.ignore
			);
			const actual = await readPng( shotFile );
			const mockup = await readPng( mockupFile );
			paint( actual, boxes );
			paint( mockup, boxes );
			const w = Math.min( actual.width, mockup.width );
			const h = Math.min( actual.height, mockup.height );
			const diff = new PNG( { width: w, height: h } );
			const mismatched = pixelmatch(
				crop( actual, w, h ).data,
				crop( mockup, w, h ).data,
				diff.data,
				w,
				h,
				{
					threshold: 0.1,
				}
			);

			await fs.writeFile(
				path.join( resultsDir, `${ id }-diff.png` ),
				PNG.sync.write( diff )
			);
			await fs.copyFile(
				mockupFile,
				path.join( resultsDir, `${ id }-mockup.png` )
			);

			result.mismatch = Number(
				( ( mismatched / ( w * h ) ) * 100 ).toFixed( 2 )
			);
			result.size = {
				actual: [ actual.width, actual.height ],
				mockup: [ mockup.width, mockup.height ],
			};
			result.heightDiff = actual.height - mockup.height;
			result.widthDiff = actual.width - mockup.width;
			const heightTolerance =
				entry.heightTolerance ?? DEFAULT_HEIGHT_TOLERANCE;
			result.heightOk =
				Math.abs( result.heightDiff ) <=
				( mockup.height * heightTolerance ) / 100;
			result.status =
				result.mismatch <= threshold && result.heightOk
					? 'pass'
					: 'fail';
		} catch ( error ) {
			result.status = 'error';
			result.error = error.message.split( '\n' )[ 0 ];
		}
		await context.close();
	}
}

await browser.close();

await fs.writeFile(
	path.join( resultsDir, 'results.json' ),
	JSON.stringify( results, null, '\t' )
);
await fs.writeFile( path.join( resultsDir, 'report.html' ), report( results ) );

for ( const r of results ) {
	let detail = `${ r.mismatch }% mismatch (limit ${ r.threshold }%), height ${
		r.heightDiff >= 0 ? '+' : ''
	}${ r.heightDiff }px${ r.heightOk ? '' : ' (too far off)' }`;
	if ( r.status === 'no-mockup' ) {
		detail = 'no mockup yet';
	} else if ( r.status === 'error' ) {
		detail = r.error;
	}
	console.log(
		`${ r.status.toUpperCase().padEnd( 9 ) } ${ r.id.padEnd( 32 ) } ${ detail }`
	);
}
console.log(
	`\nReport: ${ path.relative( process.cwd(), path.join( resultsDir, 'report.html' ) ) }`
);
if ( results.some( ( r ) => r.status === 'fail' || r.status === 'error' ) ) {
	process.exitCode = 1;
}

function report( rows ) {
	const esc = ( s ) =>
		String( s ).replace(
			/[&<>"]/g,
			( c ) =>
				( { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' } )[
					c
				]
		);
	const body = rows
		.map( ( r ) => {
			const head = `<h2><span class="badge ${ r.status }">${ r.status }</span> ${ esc( r.id ) }</h2>
<p><a href="${ esc( r.url ) }">${ esc( r.url ) }</a>${
				r.mismatch !== undefined
					? ` · ${ r.mismatch }% mismatch (limit ${ r.threshold }%) · screenshot ${ r.size.actual.join( '×' ) }, mockup ${ r.size.mockup.join( '×' ) } (height ${ r.heightDiff >= 0 ? '+' : '' }${ r.heightDiff }px)`
					: ''
			}${ r.error ? ` · ${ esc( r.error ) }` : '' }</p>`;
			if ( r.mismatch === undefined ) {
				return `<section>${ head }</section>`;
			}
			return `<section>${ head }<div class="grid">
<figure><figcaption>Screenshot</figcaption><img src="${ r.id }.png" loading="lazy"></figure>
<figure><figcaption>Mockup</figcaption><img src="${ r.id }-mockup.png" loading="lazy"></figure>
<figure><figcaption>Diff</figcaption><img src="${ r.id }-diff.png" loading="lazy"></figure>
</div></section>`;
		} )
		.join( '\n' );
	return `<!doctype html><html lang="en"><head><meta charset="utf-8"><title>NSF visual comparison</title>
<style>
body{font:14px/1.4 system-ui,sans-serif;margin:24px;color:#222}
section{border-top:1px solid #ddd;padding:16px 0}
h2{font-size:16px;margin:0 0 4px}
.badge{display:inline-block;padding:2px 8px;border-radius:10px;font-size:12px;text-transform:uppercase;background:#eee}
.pass{background:#d7f5dd}.fail,.error{background:#fbd9d9}
.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;align-items:start}
figure{margin:0}figcaption{font-weight:600;margin-bottom:4px}
img{width:100%;border:1px solid #ccc}
</style></head><body><h1>NSF visual comparison</h1>
<p>${ rows.filter( ( r ) => r.status === 'pass' ).length } of ${ rows.length } passed · ${ new Date().toISOString() }</p>
${ body }</body></html>`;
}
