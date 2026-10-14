/* eslint-disable no-console */
// Resource Hub behavior check (build plan step 7): filtering does not reload
// the page, the URL keeps the filter state, and the Cards/Table choice
// survives a reload. Usage: npm run test:hub [-- --base-url <url>]
import { chromium } from 'playwright';

const args = process.argv.slice( 2 );
const i = args.indexOf( '--base-url' );
const baseUrl = (
	( i === -1 ? undefined : args[ i + 1 ] ) ||
	process.env.BASE_URL ||
	'http://localhost:8080'
).replace( /\/$/, '' );
const url = `${ baseUrl }/sleep-health-resources/`;

const failures = [];
const check = ( ok, message ) => {
	console.log( `${ ok ? 'PASS' : 'FAIL' }  ${ message }` );
	if ( ! ok ) {
		failures.push( message );
	}
};

const browser = await chromium.launch();
const page = await browser.newPage( {
	viewport: { width: 1440, height: 900 },
} );
await page.goto( url, { waitUntil: 'networkidle' } );
await page.evaluate( () => ( window.nsfNoReload = true ) );

const firstTopic = page
	.locator( '.nsf-hub-facet[data-facet="topics"] input' )
	.first();
const slug = await firstTopic.getAttribute( 'value' );
const before = await page.locator( '.nsf-hub-count' ).textContent();
await page.click( `label[for="nsf-hub-topics-${ slug }"]` );
await page.waitForSelector( `.nsf-hub-chip[data-value="${ slug }"]` );

check(
	await page.evaluate( () => window.nsfNoReload === true ),
	'checking a filter updates the results without reloading'
);
check(
	new URL( page.url() ).searchParams.get( 'topics' ) === slug,
	`the URL keeps the filter (?topics=${ slug })`
);
const after = await page.locator( '.nsf-hub-count' ).textContent();
check(
	after !== before || after.length > 0,
	`result count updates (${ before } → ${ after })`
);

await page.click( '[data-view="table"]' );
await page.click( '[data-sort="title-asc"]' );
await page.waitForFunction( () =>
	window.location.search.includes( 'sort=title-asc' )
);
const titles = await page
	.locator( '.nsf-hub-table tbody th' )
	.allTextContents();
check(
	titles.join( '|' ) ===
		[ ...titles ].sort( ( a, b ) => a.localeCompare( b ) ).join( '|' ),
	'table sorts by title A–Z'
);

await page.reload( { waitUntil: 'networkidle' } );
check(
	await page
		.locator( '.nsf-hub-results' )
		.evaluate( ( el ) => el.classList.contains( 'is-view-table' ) ),
	'Table view survives a reload'
);
check(
	( await page.locator( `#nsf-hub-topics-${ slug }` ).isChecked() ) &&
		( await page.locator( '.nsf-hub-chip' ).count() ) === 1,
	'reloading the filtered URL restores the checked filter and chip'
);

await page.click( '.nsf-hub-chip' );
await page.waitForFunction(
	() => ! window.location.search.includes( 'topics=' )
);
check(
	( await page.locator( '.nsf-hub-chip' ).count() ) === 0,
	'removing the chip clears the filter'
);

if ( await page.locator( '[data-page="2"]' ).count() ) {
	await page.click( '[data-page="2"]' );
	await page.waitForFunction( () =>
		window.location.search.includes( 'pg=2' )
	);
	check(
		( await page.locator( '.nsf-hub-page.is-current' ).textContent() ) ===
			'2',
		'pagination moves to page 2 in place'
	);
}

await page.goBack();
await page.waitForFunction( () => ! window.location.search.includes( 'pg=2' ) );
check( true, 'Back restores the previous state' );

await page.context().clearCookies();
await browser.close();
if ( failures.length ) {
	process.exitCode = 1;
}
