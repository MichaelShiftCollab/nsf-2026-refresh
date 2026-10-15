/* eslint-disable no-console */
// Global parts behavior check (build plan step 5): header search lands on
// the search results page, the mobile menu opens with every link, and the
// Alert Banner prints nothing when it is off.
// Usage: npm run test:global [-- --base-url <url>]
import { execFileSync } from 'node:child_process';
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

const browser = await chromium.launch();

// Header search: the icon opens the field; Enter goes to the results page.
{
	const page = await browser.newPage( {
		viewport: { width: 1440, height: 800 },
	} );
	await page.goto( `${ baseUrl }/sleep-health-resources/` );
	await page.click( '.nsf-header-search .wp-block-search__button' );
	const input = page.locator( '.nsf-header-search input[type="search"]' );
	await input.fill( 'insomnia' );
	await Promise.all( [
		page.waitForURL( /[?&]s=insomnia/ ),
		input.press( 'Enter' ),
	] );
	check(
		new URL( page.url() ).searchParams.get( 's' ) === 'insomnia',
		'header search submits to the search results page'
	);
	await page.close();
}

// Mobile menu: one button opens the main and utility links.
{
	const page = await browser.newPage( {
		viewport: { width: 600, height: 800 },
	} );
	await page.goto( `${ baseUrl }/sleep-health-resources/` );
	await page.click(
		'.nsf-main-nav .wp-block-navigation__responsive-container-open'
	);
	const labels = await page
		.locator(
			'.nsf-main-nav .is-menu-open .wp-block-navigation-item__label'
		)
		.allInnerTexts();
	check(
		[
			'National Programs',
			'Sleep Health Resources',
			'About Us',
			'Media Center',
		].every( ( label ) =>
			labels.some( ( text ) => text.includes( label ) )
		),
		`mobile menu lists the main and utility links (${ labels.length } links)`
	);
	await page.close();
}

await browser.close();

// Alert Banner: on renders the banner, off renders nothing.
const render = ( enabled ) =>
	execFileSync(
		'php',
		[
			'bin/wp',
			'eval',
			`echo render_block( array( 'blockName' => 'nsf/alert-banner', 'attrs' => array( 'enabled' => ${ enabled }, 'text' => 'Test', 'linkText' => 'Go', 'url' => '/' ), 'innerBlocks' => array(), 'innerHTML' => '', 'innerContent' => array() ) );`,
			'--allow-root',
		],
		{ encoding: 'utf8' }
	);
check( render( 'true' ).includes( 'nsf-alert' ), 'Alert Banner shows when on' );
check( render( 'false' ).trim() === '', 'Alert Banner is removed when off' );

if ( failures.length ) {
	process.exit( 1 );
}
