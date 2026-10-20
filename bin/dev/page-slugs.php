<?php
/**
 * Renames existing pages to the slugs in content/page-slugs.csv (the content
 * plan's old-site URLs, kept under the new page hierarchy). Safe to run more
 * than once: pages already renamed are skipped. Also trashes the empty
 * Research > Sleep in America® Polls stub once the real page exists under
 * NSF Research Reports.
 *
 * Run: php bin/wp eval-file bin/dev/page-slugs.php --allow-root
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

// Old path => new slug, parents before children.
$nsf_renames = array(
	'sleeptech'                                              => 'about-sleeptech',
	'about-sleeptech/sleeptech-network/sleeptech-network-membership' => 'membership-application',
	'national-programs/drowsy-driving-prevention-week'      => 'drowsy-driving-prevention',
	'sleep-health-resources/sleep-learning-zone'            => 'sleep-health-topics',
	'about-us'                                              => 'mission-and-goals',
	'contact-us'                                            => 'contact',
);

foreach ( $nsf_renames as $nsf_old => $nsf_slug ) {
	$nsf_page = get_page_by_path( $nsf_old );
	if ( ! $nsf_page ) {
		continue;
	}
	wp_update_post(
		array(
			'ID'        => $nsf_page->ID,
			'post_name' => $nsf_slug,
		)
	);
	WP_CLI::log( "/{$nsf_old}/ is now " . wp_make_link_relative( get_permalink( $nsf_page->ID ) ) );
}

$nsf_stub = get_page_by_path( 'research/sleep-in-america-polls' );
if ( $nsf_stub && get_page_by_path( 'research/nsf-research-reports/sleep-in-america-polls' ) ) {
	wp_trash_post( $nsf_stub->ID );
	WP_CLI::log( 'Trashed the empty /research/sleep-in-america-polls/ stub.' );
}

flush_rewrite_rules( false );
WP_CLI::success( 'Page slugs match content/page-slugs.csv.' );
