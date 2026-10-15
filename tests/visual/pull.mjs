/* eslint-disable no-console */
// Exports the Figma frames in mockups.json to mockups/<name>-<width>.png at 1x.
// Needs a Figma personal access token in FIGMA_TOKEN. Existing files are kept unless --force.
// Without network access to api.figma.com, export through the Figma MCP server instead
// (get_screenshot with maxDimension set to the frame's longer edge) and save to the same path.
import fs from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import { PNG } from 'pngjs';

const dir = path.dirname( fileURLToPath( import.meta.url ) );
const FILE_KEY = 'mVNfIISs9yQQurddJagkfU';
const force = process.argv.includes( '--force' );
const token = process.env.FIGMA_TOKEN;

const mockups = JSON.parse(
	await fs.readFile( path.join( dir, 'mockups.json' ), 'utf8' )
);
await fs.mkdir( path.join( dir, 'mockups' ), { recursive: true } );

const todo = [];
for ( const m of mockups ) {
	const file = path.join( dir, 'mockups', `${ m.name }-${ m.width }.png` );
	const exists = await fs.access( file ).then(
		() => true,
		() => false
	);
	if ( exists && ! force ) {
		console.log( `keep   ${ path.basename( file ) }` );
	} else {
		todo.push( { ...m, file } );
	}
}

if ( todo.length && ! token ) {
	console.error(
		`Missing FIGMA_TOKEN; cannot export ${ todo.map( ( m ) => m.name ).join( ', ' ) }.`
	);
	process.exit( 1 );
}

if ( todo.length ) {
	const ids = todo.map( ( m ) => m.node ).join( ',' );
	const res = await fetch(
		`https://api.figma.com/v1/images/${ FILE_KEY }?ids=${ encodeURIComponent( ids ) }&format=png&scale=1`,
		{
			headers: { 'X-Figma-Token': token },
		}
	);
	if ( ! res.ok ) {
		console.error( `Figma API ${ res.status }: ${ await res.text() }` );
		process.exit( 1 );
	}
	const { images } = await res.json();
	for ( const m of todo ) {
		const url = images[ m.node ];
		if ( ! url ) {
			console.error( `no image for ${ m.name } (${ m.node })` );
			process.exitCode = 1;
			continue;
		}
		let png = Buffer.from( await ( await fetch( url ) ).arrayBuffer() );
		// "crop": { "y", "height" } keeps a band of the frame, e.g. Home
		// without the header and footer, which are tested on their own.
		if ( m.crop ) {
			const full = PNG.sync.read( png );
			const out = new PNG( { width: full.width, height: m.crop.height } );
			PNG.bitblt(
				full,
				out,
				0,
				m.crop.y,
				full.width,
				m.crop.height,
				0,
				0
			);
			png = PNG.sync.write( out );
		}
		await fs.writeFile( m.file, png );
		console.log( `pulled ${ path.basename( m.file ) }` );
	}
}
