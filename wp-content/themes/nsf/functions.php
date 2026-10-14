<?php
/**
 * NSF child theme functions.
 *
 * Presentation only: styles, fonts, block styles and patterns.
 * Post types, taxonomies, custom blocks and site functions live in the NSF plugin.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue the child theme stylesheet after Frost's.
 */
function nsf_theme_enqueue_styles() {
	wp_enqueue_style(
		'nsf-theme',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'nsf_theme_enqueue_styles' );

/**
 * Register the NSF pattern categories.
 */
function nsf_theme_pattern_categories() {
	register_block_pattern_category(
		'nsf-cards',
		array(
			'label'       => __( 'NSF: Cards', 'nsf' ),
			'description' => __( 'Content Card grids.', 'nsf' ),
		)
	);
}
add_action( 'init', 'nsf_theme_pattern_categories' );
