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
	// Header, sign-up row and footer refinements.
	wp_enqueue_style(
		'nsf-global',
		get_theme_file_uri( 'assets/css/global.css' ),
		array( 'nsf-theme' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'nsf_theme_enqueue_styles' );

/**
 * Preload the upright Open Sans file, used by nearly all text, so it starts
 * downloading before the stylesheet that names it is parsed.
 */
function nsf_theme_preload_fonts() {
	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( get_theme_file_uri( 'assets/fonts/open-sans/OpenSans-Variable.woff2' ) )
	);
}
add_action( 'wp_head', 'nsf_theme_preload_fonts', 1 );

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
 * Interior page section styles (build plan step 15): one file per page in
 * assets/css/pages/. The editor loads them all so the sections can be reused
 * anywhere; a page on the front end loads only the files whose classes its
 * content uses.
 *
 * @return string[] Theme-relative paths.
 */
function nsf_theme_page_styles() {
	return array_map(
		static fn( $file ) => 'assets/css/pages/' . basename( $file ),
		glob( __DIR__ . '/assets/css/pages/*.css' )
	);
}

/**
 * The nsf- class names a page style file targets, cached until it changes.
 *
 * @param string $file Theme-relative path.
 * @return string[]
 */
function nsf_theme_page_style_classes( $file ) {
	$path  = get_theme_file_path( $file );
	$key   = 'nsf_css_classes_' . md5( $file . filemtime( $path ) );
	$names = get_transient( $key );
	if ( false === $names ) {
		preg_match_all( '/\.(nsf-[a-z0-9_-]+)/', (string) file_get_contents( $path ), $m ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- local theme file.
		$names = array_values( array_unique( $m[1] ) );
		set_transient( $key, $names, MONTH_IN_SECONDS );
	}
	return $names;
}

/**
 * Enqueue the section styles a page uses. Each carries its file path, so
 * WordPress prints small ones inline instead of as render-blocking links.
 */
function nsf_theme_enqueue_page_styles() {
	if ( is_singular( 'resource' ) ) {
		$file = 'assets/css/pages/resource-single.css';
		wp_enqueue_style( 'nsf-page-resource-single', get_theme_file_uri( $file ), array( 'nsf-theme' ), wp_get_theme()->get( 'Version' ) );
		wp_style_add_data( 'nsf-page-resource-single', 'path', get_theme_file_path( $file ) );
		return;
	}
	if ( ! is_page() ) {
		return;
	}
	$content = (string) get_post_field( 'post_content', get_queried_object_id() );
	// Synced patterns keep their blocks elsewhere; load everything for those.
	$all = str_contains( $content, '<!-- wp:block ' ) || str_contains( $content, '<!-- wp:pattern ' );
	foreach ( nsf_theme_page_styles() as $file ) {
		$used = $all;
		foreach ( $used ? array() : nsf_theme_page_style_classes( $file ) as $name ) {
			if ( preg_match( '/[\s"]' . preg_quote( $name, '/' ) . '[\s"]/', $content ) ) {
				$used = true;
				break;
			}
		}
		if ( ! $used ) {
			continue;
		}
		$handle = 'nsf-page-' . basename( $file, '.css' );
		wp_enqueue_style( $handle, get_theme_file_uri( $file ), array( 'nsf-theme' ), wp_get_theme()->get( 'Version' ) );
		wp_style_add_data( $handle, 'path', get_theme_file_path( $file ) );
	}
}
add_action( 'wp_enqueue_scripts', 'nsf_theme_enqueue_page_styles' );

/**
 * Load more for Query Loops with the nsf-load-more class (press releases).
 */
function nsf_theme_enqueue_load_more() {
	if ( is_singular() && str_contains( (string) get_post_field( 'post_content', get_queried_object_id() ), 'nsf-load-more' ) ) {
		wp_enqueue_script(
			'nsf-load-more',
			get_theme_file_uri( 'assets/js/load-more.js' ),
			array(),
			wp_get_theme()->get( 'Version' ),
			array( 'strategy' => 'defer' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'nsf_theme_enqueue_load_more' );

/**
 * Give theme images placed by patterns (logos, the seal) their intrinsic
 * width and height, so the browser reserves their space before they load.
 *
 * @param string $html  Block HTML.
 * @return string
 */
function nsf_theme_image_dimensions( $html ) {
	$tags = new WP_HTML_Tag_Processor( $html );
	$base = get_stylesheet_directory_uri() . '/';
	while ( $tags->next_tag( 'img' ) ) {
		$src = (string) $tags->get_attribute( 'src' );
		if ( null !== $tags->get_attribute( 'width' ) || ! str_starts_with( $src, $base ) ) {
			continue;
		}
		$size = wp_getimagesize( get_stylesheet_directory() . '/' . substr( strtok( $src, '?' ), strlen( $base ) ) );
		if ( $size ) {
			$tags->set_attribute( 'width', (string) $size[0] );
			$tags->set_attribute( 'height', (string) $size[1] );
		}
	}
	return $tags->get_updated_html();
}
add_filter( 'render_block_core/image', 'nsf_theme_image_dimensions' );

/**
 * Show the interior page section styles in the editor.
 */
function nsf_theme_page_editor_styles() {
	add_editor_style( array_merge( array( 'assets/css/global.css' ), nsf_theme_page_styles() ) );
}
add_action( 'after_setup_theme', 'nsf_theme_page_editor_styles' );

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
