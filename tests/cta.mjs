/* eslint-disable no-console */
// CTA and callout behavior check (build plan step 9), on the private CTA Test
// page built by bin/dev/cta-test-page.php. The Gated Download page does not
// contain the file's URL; submitting its form lands on the success page with
// the cover and a working download; a tampered link shows no file; and every
// block on the page is valid in the editor.
// Usage: npm run test:cta [-- --base-url <url>]
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
const context = await browser.newContext( {
	viewport: { width: 1440, height: 900 },
	acceptDownloads: true,
} );
const page = await context.newPage();

await page.goto(
	`${ baseUrl }/wp-login.php?redirect_to=${ encodeURIComponent(
		`${ baseUrl }/cta-test/`
	) }`
);
await page.fill( '#user_login', process.env.WP_USER || 'admin' );
await page.fill( '#user_pass', process.env.WP_PASS || 'admin' );
await Promise.all( [
	page.waitForURL( /cta-test/, { timeout: 60000 } ),
	page.click( '#wp-submit' ),
] );

// The file's address is not in the page before the form is sent.
const html = await page.content();
check(
	! /\.pdf/i.test( html ),
	'the Gated Download page does not contain the file URL'
);
check(
	( await page.locator( '#cta-gated input[name="nsf_gate"]' ).count() ) === 1,
	'the Gated Download form carries a signed token'
);

// Submit the form.
const form = page.locator( '#cta-gated form' );
await form.locator( 'input[name="input_1"]' ).fill( 'Test Company' );
await form.locator( 'input[name="input_3"]' ).fill( 'Test' );
await form.locator( 'input[name="input_4"]' ).fill( 'Person' );
await form.locator( 'input[name="input_5"]' ).fill( 'Tester' );
await form.locator( 'input[name="input_6"]' ).fill( 'test@example.com' );
await form.locator( 'input[type="checkbox"]' ).first().check();
await Promise.all( [
	page.waitForURL( /prospectus-thank-you\/\?nsf_download=/, {
		timeout: 30000,
	} ),
	form.locator( 'button[type="submit"]' ).click(),
] );
check( true, 'submitting the form lands on the success page' );
const successUrl = page.url();
check(
	( await page.locator( '.nsf-gated-success__cover img' ).count() ) === 1,
	'the success page shows the cover'
);

// The download works, for anyone holding the link.
const visitor = await browser.newContext( { acceptDownloads: true } );
const visitorPage = await visitor.newPage();
await visitorPage.goto( successUrl );
const [ download ] = await Promise.all( [
	visitorPage.waitForEvent( 'download' ),
	visitorPage.click( '.nsf-download-button' ),
] );
const stream = await download.createReadStream();
const chunks = [];
for await ( const chunk of stream ) {
	chunks.push( chunk );
}
const bytes = Buffer.concat( chunks );
check(
	bytes.subarray( 0, 5 ).toString() === '%PDF-',
	`the download button delivers the PDF (${ download.suggestedFilename() }, ${ bytes.length } bytes)`
);

// A changed token is refused.
const tampered = successUrl.replace( /nsf_download=([^&]+)/, ( m, t ) =>
	m.replace( t, t.slice( 0, -2 ) + ( t.endsWith( 'aa' ) ? 'bb' : 'aa' ) )
);
await visitorPage.goto( tampered );
check(
	( await visitorPage.locator( '.nsf-download-button' ).count() ) === 0 &&
		( await visitorPage
			.locator( '.nsf-gated-success__expired' )
			.count() ) === 1,
	'a tampered link shows no download'
);
await visitor.close();

// Every block on the CTA Test page is valid in the editor.
await page.goto( `${ baseUrl }/cta-test/` );
const id = await page.evaluate(
	() => document.body.className.match( /page-id-(\d+)/ )?.[ 1 ]
);
await page.goto( `${ baseUrl }/wp-admin/post.php?post=${ id }&action=edit` );
await page.waitForFunction(
	() => window.wp?.data?.select( 'core/block-editor' )?.getBlockCount() > 0,
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

await browser.close();
if ( failures.length ) {
	process.exitCode = 1;
}
