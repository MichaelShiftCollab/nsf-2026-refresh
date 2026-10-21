<?php
/**
 * Creates or refreshes the interior pages (build plan step 15) from their
 * page patterns, with placeholder content matching the mockups in
 * /mnt/project-files/mockups. Parents missing from the site outline path are
 * created as empty published pages. Slugs follow the content plan: a page
 * that pairs with an old-site page keeps its slug (docs/decisions.md).
 *
 * Run: php bin/wp eval-file bin/dev/interior-pages.php [slug ...] --allow-root
 * With slugs (the last part of each path), only those pages are refreshed.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

// Path => [ title, subtitle, template, page pattern ]. Each page's content is
// the nsf/page-<pattern> pattern. Pages whose title band differs from the
// standard one (an eyebrow, a photo, a contact box) use the "No Title"
// template and start with their own title band section.
$nsf_interior_pages = array(
	'national-programs'                                                 => array( 'National Programs', '', 'no-title', 'national-programs' ),
	'national-programs/sleep-awareness-week'                            => array( 'Sleep Awareness Week®', '', 'no-title', 'sleep-awareness-week' ),
	'national-programs/drowsy-driving-prevention'                       => array( 'Drowsy Driving Prevention Week®', '', 'no-title', 'drowsy-driving-prevention-week' ),
	'national-programs/drowsy-driving-prevention/drowsy-driving-prevention-resources' => array( 'Drowsy Driving Prevention Resources', '', 'no-title', 'drowsy-driving-prevention-resources' ),
	'research/nsf-research-reports/sleep-in-america-polls'              => array( 'Sleep in America® Polls', '', 'no-title', 'sleep-in-america-polls' ),
	'about-sleeptech/sleeptech-network/membership-application'          => array( 'SleepTech® Network Membership', '', '', 'sleeptech-network-membership' ),
	'media-center'                                                      => array( 'Media Center', '', 'no-title', 'media-center' ),
);

$nsf_only = array_filter( $args ?? array() );

/**
 * Finds a page by path, creating it (and its parents) when missing.
 *
 * @param string $path  Page path.
 * @param string $title Title for a new page.
 * @return int Page ID.
 */
function nsf_interior_page( $path, $title ) {
	$page = get_page_by_path( $path );
	if ( $page ) {
		return (int) $page->ID;
	}
	$parts  = explode( '/', $path );
	$slug   = array_pop( $parts );
	$names  = array(
		'nsf-research-reports' => 'NSF Research Reports',
		'about-sleeptech'      => 'SleepTech®',
		'sleeptech-network'    => 'SleepTech® Network',
	);
	$parent = $parts ? nsf_interior_page( implode( '/', $parts ), $names[ end( $parts ) ] ?? ucwords( str_replace( '-', ' ', end( $parts ) ) ) ) : 0;
	return (int) wp_insert_post(
		array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => $title,
			'post_name'   => $slug,
			'post_parent' => $parent,
		)
	);
}

$nsf_registry = WP_Block_Patterns_Registry::get_instance();
foreach ( $nsf_interior_pages as $nsf_path => $nsf_page ) {
	$nsf_slug = basename( $nsf_path );
	if ( $nsf_only && ! in_array( $nsf_slug, $nsf_only, true ) ) {
		continue;
	}
	$nsf_pattern = $nsf_registry->get_registered( 'nsf/page-' . $nsf_page[3] );
	if ( ! $nsf_pattern ) {
		WP_CLI::warning( "No nsf/page-{$nsf_page[3]} pattern yet; skipped {$nsf_path}." );
		continue;
	}
	$nsf_id = nsf_interior_page( $nsf_path, $nsf_page[0] );
	wp_update_post(
		array(
			'ID'            => $nsf_id,
			'post_title'    => $nsf_page[0],
			'post_content'  => $nsf_pattern['content'],
			'post_status'   => 'publish',
			'page_template' => $nsf_page[2],
			'meta_input'    => array( 'nsf_subtitle' => $nsf_page[1] ),
		)
	);
	WP_CLI::log( "{$nsf_page[0]}: " . get_permalink( $nsf_id ) );
}
WP_CLI::success( 'Interior pages ready.' );
