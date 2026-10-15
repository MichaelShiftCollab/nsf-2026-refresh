/* eslint-disable no-console */
// Accessibility check (build spec: WCAG 2.2 AA): runs axe-core against the main
// templates at 1440 and 390 and fails on any WCAG 2.2 A or AA violation.
// Usage: npm run test:a11y [-- --base-url <url>] [-- --grep <path part>]
import { createRequire } from 'node:module';
import { chromium } from 'playwright';

const require = createRequire( import.meta.url );
const axeSource = require( 'axe-core' ).source;

const args = process.argv.slice( 2 );
const arg = ( name ) => {
	const i = args.indexOf( name );
	return i === -1 ? undefined : args[ i + 1 ];
};
const baseUrl = (
	arg( '--base-url' ) ||
	process.env.BASE_URL ||
	'http://localhost:8080'
).replace( /\/$/, '' );
const grep = arg( '--grep' );

const PATHS = [
	'/',
	'/sleep-health-resources/',
	'/sleep-health-resources/?topics=insomnia&view=table',
	'/resources/sleep-in-america-poll-2026-a-look-at-childrens-sleep-health-and-family-sleep-habits/',
	'/sleep-health-resources/sleep-learning-zone/',
	'/heres-something-your-kids-mood-grades-and-immunity-have-in-common/',
	'/?s=sleep',
	'/no-such-page/',
	'/national-programs/',
	'/national-programs/sleep-awareness-week/',
	'/national-programs/drowsy-driving-prevention-week/',
	'/national-programs/drowsy-driving-prevention-week/drowsy-driving-prevention-resources/',
	'/research/nsf-research-reports/sleep-in-america-polls/',
	'/sleeptech/sleeptech-network/sleeptech-network-membership/',
	'/media-center/',
].filter( ( path ) => ! grep || path.includes( grep ) );

const browser = await chromium.launch();
let failed = 0;
for ( const width of [ 1440, 390 ] ) {
	const page = await browser.newPage( { viewport: { width, height: 900 } } );
	for ( const path of PATHS ) {
		await page.goto( baseUrl + path, { waitUntil: 'networkidle' } );
		await page.addScriptTag( { content: axeSource } );
		const violations = await page.evaluate( async () => {
			const result = await window.axe.run( document, {
				runOnly: [
					'wcag2a',
					'wcag2aa',
					'wcag21a',
					'wcag21aa',
					'wcag22aa',
				],
			} );
			return result.violations.map( ( v ) => ( {
				id: v.id,
				impact: v.impact,
				help: v.help,
				targets: v.nodes
					.slice( 0, 4 )
					.map( ( n ) => n.target.join( ' ' ) ),
				count: v.nodes.length,
			} ) );
		} );
		console.log(
			`${ violations.length ? 'FAIL' : 'PASS' }  ${ width }  ${ path }`
		);
		for ( const v of violations ) {
			failed++;
			console.log(
				`      ${ v.impact } ${ v.id } (${ v.count }): ${ v.help }`
			);
			v.targets.forEach( ( t ) => console.log( `        ${ t }` ) );
		}
	}
	await page.close();
}
await browser.close();
process.exit( failed ? 1 : 0 );
