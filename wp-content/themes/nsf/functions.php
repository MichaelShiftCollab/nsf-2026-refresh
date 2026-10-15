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

require_once __DIR__ . '/inc/campaign-band.php';

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
 * Enqueue the search, archive and 404 template styles on those views only.
 */
function nsf_theme_enqueue_listing_styles() {
	if ( is_search() || is_home() || is_archive() || is_404() ) {
		wp_enqueue_style(
			'nsf-listings',
			get_theme_file_uri( 'assets/css/listings.css' ),
			array( 'nsf-theme' ),
			wp_get_theme()->get( 'Version' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'nsf_theme_enqueue_listing_styles' );

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
	register_block_pattern_category(
		'nsf-sections',
		array(
			'label'       => __( 'NSF: Sections', 'nsf' ),
			'description' => __( 'Full-width page sections, such as those on Home.', 'nsf' ),
		)
	);
	register_block_pattern_category(
		'nsf-campaigns',
		array(
			'label'       => __( 'NSF: Campaign bands', 'nsf' ),
			'description' => __( 'Best Slept Self®, Drowsy Driving Prevention Week® and Sleep Awareness Week® bands. Swap one for another by hand.', 'nsf' ),
		)
	);
	register_block_pattern_category(
		'nsf-ctas',
		array(
			'label'       => __( 'NSF: Calls to action and callouts', 'nsf' ),
			'description' => __( 'CTA rows, CTAs with a form or link, Gated Download, statistics and pull quotes.', 'nsf' ),
		)
	);
	register_block_pattern_category(
		'nsf-pages',
		array(
			'label'       => __( 'NSF: Page layouts', 'nsf' ),
			'description' => __( 'Whole-page layouts such as the Resource Hub.', 'nsf' ),
		)
	);
}
add_action( 'init', 'nsf_theme_pattern_categories' );
