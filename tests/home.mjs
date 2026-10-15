/* eslint-disable no-console */
// Home behavior check (build plan step 8): the hero fits above the fold at
// 1440 x 800, rotates its images, and stays on the first image when the
// visitor prefers reduced motion. Also opens the Home page in the editor and
// fails on any invalid block. Usage: npm run test:home [-- --base-url <url>]
import { chromium } from 'playwright';

const args = process.argv.slice( 2 );
const i = args.indexOf( '--base-url' );
const baseUrl = (
	( i === -1 ? undefined : args[ i + 1 ] ) ||
	process.env.BASE_URL ||
	'http://localhost:8080'
).replace( /\/$/, '' );

const failures = [];
const check = ( ok, message ) => {
	console.log( `${ ok ? 'PASS' : 'FAIL' }  ${ message }` );
	if ( ! ok ) {
		failures.push( message );
	}
};

const activeIndex = ( page ) =>
	page.evaluate( () =>
		[ ...document.querySelectorAll( '.nsf-hero__image' ) ].findIndex(
			( img ) => img.classList.contains( 'is-active' )
		)
	);

// Waits past the hero's default interval (six seconds).
const INTERVAL_WAIT = 7000;

const browser = await chromium.launch();

// Motion allowed: the hero advances and ends above the fold.
{
	const page = await browser.newPage( {
		viewport: { width: 1440, height: 800 },
	} );
	await page.goto( `${ baseUrl }/`, { waitUntil: 'networkidle' } );
	const count = await page.locator( '.nsf-hero__image' ).count();
	check( count === 6, `hero has six images (found ${ count })` );
	const bottom = await page.evaluate(
		() =>
			document.querySelector( '.nsf-hero' ).getBoundingClientRect().bottom
	);
	check(
		bottom <= 800,
		`hero ends above the fold (bottom ${ Math.round( bottom ) }px)`
	);
	await page.waitForTimeout( INTERVAL_WAIT );
	check( ( await activeIndex( page ) ) > 0, 'hero rotates on its own' );
	check(
		( await page
			.locator( '[data-nsf-hero] button, [role="tab"]' )
			.count() ) === 0,
		'hero has no slide indicators'
	);
	await page.close();
}

// Reduced motion: the first image stays.
{
	const page = await browser.newPage( {
		viewport: { width: 1440, height: 800 },
		reducedMotion: 'reduce',
	} );
	await page.goto( `${ baseUrl }/`, { waitUntil: 'networkidle' } );
	await page.waitForTimeout( INTERVAL_WAIT );
	check(
		( await activeIndex( page ) ) === 0,
		'hero stays still under prefers-reduced-motion'
	);
	await page.close();
}

// Editor: every block on the Home page is valid.
{
	const page = await browser.newPage( {
		viewport: { width: 1440, height: 900 },
	} );
	const res = await page.request.get(
		`${ baseUrl }/wp-json/wp/v2/pages?slug=home&_fields=id`
	);
	const id = ( await res.json() )[ 0 ]?.id;
	const editUrl = `${ baseUrl }/wp-admin/post.php?post=${ id }&action=edit`;
	await page.goto(
		`${ baseUrl }/wp-login.php?redirect_to=${ encodeURIComponent( editUrl ) }`
	);
	await page.fill( '#user_login', process.env.WP_USER || 'admin' );
	await page.fill( '#user_pass', process.env.WP_PASS || 'admin' );
	await Promise.all( [
		page.waitForURL( /post\.php/, { timeout: 60000 } ),
		page.click( '#wp-submit' ),
	] );
	await page.waitForFunction(
		() =>
			window.wp?.data?.select( 'core/block-editor' )?.getBlockCount() > 0,
		null,
		{ timeout: 60000 }
	);
	const invalid = await page.evaluate( () => {
		const { select } = window.wp.data;
		const walk = ( blocks ) =>
			blocks.flatMap( ( block ) => [
				...( block.isValid === false ? [ block.name ] : [] ),
				...walk( block.innerBlocks ),
			] );
		return walk( select( 'core/block-editor' ).getBlocks() );
	} );
	check(
		invalid.length === 0,
		`no invalid blocks in the editor${
			invalid.length ? ` (${ invalid.join( ', ' ) })` : ''
		}`
	);
	await page.close();
}

await browser.close();
if ( failures.length ) {
	process.exit( 1 );
}
