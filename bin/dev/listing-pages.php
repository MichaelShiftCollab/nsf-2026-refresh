<?php
/**
 * Creates the pages the search, archive and 404 templates need locally
 * (build plan steps 13 and 14): the Sleep Learning Zone® page, set as the
 * posts page under Sleep Health Resources, and stub pages from the site
 * outline so search results include pages with a site section eyebrow.
 * Adds a stub Home page as the front page if none is set, because the posts
 * page only applies with a static front page.
 *
 * Stubs are marked _nsf_seed. Pass "delete" to remove them.
 *
 * Run: php bin/wp eval-file bin/dev/listing-pages.php [delete] --allow-root
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

if ( in_array( 'delete', $args ?? array(), true ) ) {
	$ids = get_posts(
		array(
			'post_type'   => 'page',
			'post_status' => 'any',
			'meta_key'    => '_nsf_seed', // phpcs:ignore WordPress.DB.SlowDBQuery
			'fields'      => 'ids',
			'numberposts' => -1,
			// Keep the front page: bin/dev/home-page.php may have filled the stub Home.
			'exclude'     => array( (int) get_option( 'page_on_front' ) ),
		)
	);
	foreach ( $ids as $id ) {
		wp_delete_post( $id, true );
	}
	update_option( 'page_for_posts', 0 );
	if ( ! get_post( (int) get_option( 'page_on_front' ) ) ) {
		update_option( 'show_on_front', 'posts' );
		update_option( 'page_on_front', 0 );
	}
	WP_CLI::success( sprintf( 'Deleted %d stub pages.', count( $ids ) ) );
	return;
}

/**
 * Returns the ID of a page by path, creating a stub if it is missing.
 *
 * @param string $title   Title.
 * @param string $slug    Slug.
 * @param int    $parent  Parent page ID.
 * @param string $content Content.
 * @return int
 */
function nsf_stub_page( $title, $slug, $parent = 0, $content = '' ) {
	$path     = $parent ? get_page_uri( $parent ) . '/' . $slug : $slug;
	$existing = get_page_by_path( $path );
	if ( $existing ) {
		return $existing->ID;
	}
	$text = $content ? $content : 'Placeholder copy for ' . $title . '. Sleep health information and resources from the National Sleep Foundation.';
	return (int) wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_parent'  => $parent,
			'post_excerpt' => $text,
			'post_content' => '<!-- wp:paragraph --><p>' . esc_html( $text ) . '</p><!-- /wp:paragraph -->',
			'meta_input'   => array( '_nsf_seed' => 1 ),
		)
	);
}

$nsf_hub      = nsf_stub_page( 'Sleep Health Resources', 'sleep-health-resources' );
$nsf_blog     = nsf_stub_page( 'Sleep Learning Zone®', 'sleep-health-topics', $nsf_hub );
$nsf_programs = nsf_stub_page( 'National Programs', 'national-programs' );
nsf_stub_page( 'Drowsy Driving Prevention Week®', 'drowsy-driving-prevention', $nsf_programs, 'Sleep First. Drive Alert.® NSF’s annual campaign encourages everyone to prioritize sleep and drive when they are alert and refreshed.' );
nsf_stub_page( 'Sleep Awareness Week®', 'sleep-awareness-week', $nsf_programs, 'NSF’s annual campaign to celebrate sleep health and help everyone sleep better.' );
nsf_stub_page( 'Best Slept Self®', 'best-slept-self', $nsf_programs, 'Simple steps to sleep well and be your best slept self.' );
$nsf_research = nsf_stub_page( 'Research', 'research' );
nsf_stub_page( 'Sleep in America® Polls', 'sleep-in-america-polls', nsf_stub_page( 'NSF Research Reports', 'nsf-research-reports', $nsf_research ), 'NSF’s annual poll on how Americans sleep, from drowsy driving to family sleep habits.' );
foreach ( array( 'SleepTech®' => 'about-sleeptech', 'SleepMark®' => 'sleepmark', 'Media Center' => 'media-center', 'About Us' => 'mission-and-goals', 'Contact Us' => 'contact' ) as $nsf_title => $nsf_slug ) {
	nsf_stub_page( $nsf_title, $nsf_slug );
}

// The posts page only takes effect with a static front page.
if ( 'page' !== get_option( 'show_on_front' ) || ! get_option( 'page_on_front' ) ) {
	update_option( 'page_on_front', nsf_stub_page( 'Home', 'home' ) );
	update_option( 'show_on_front', 'page' );
}
update_option( 'page_for_posts', $nsf_blog );
WP_CLI::success( 'Listing pages ready. Posts page: ' . get_permalink( $nsf_blog ) );
