<?php
/**
 * Registers every block built from src/blocks/<block-name> into build/.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register all NSF blocks found in the build directory.
 */
function nsf_register_blocks() {
	$manifest = NSF_PATH . 'build/blocks-manifest.php';

	if ( file_exists( $manifest ) && function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		wp_register_block_types_from_metadata_collection( NSF_PATH . 'build', $manifest );
		return;
	}

	foreach ( glob( NSF_PATH . 'build/*/block.json' ) ?: array() as $block_json ) {
		register_block_type( dirname( $block_json ) );
	}
}
add_action( 'init', 'nsf_register_blocks' );
