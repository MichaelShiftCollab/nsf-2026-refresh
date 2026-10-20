<?php
/**
 * Renames pages created before the October 20 slug decision to the slugs in
 * the content plan (docs/decisions.md): a page that pairs with an old-site page
 * keeps that page's slug. Safe to re-run; pages already renamed are skipped.
 * Also removes the stub /research/sleep-in-america-polls/ page, a duplicate of
 * /research/nsf-research-reports/sleep-in-america-polls/.
 *
 * Run before bin/dev/listing-pages.php and bin/dev/interior-pages.php:
 * php bin/wp eval-file bin/dev/page-slugs.php --allow-root
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

// Old path => new slug. Parents come first, so later paths use the new parent slug.
$nsf_renames = array(
	'national-programs/drowsy-driving-prevention-week'            => 'drowsy-driving-prevention',
	'sleep-health-resources/sleep-learning-zone'                  => 'sleep-health-topics',
	'sleeptech'                                                   => 'about-sleeptech',
	'about-sleeptech/sleeptech-network/sleeptech-network-membership' => 'membership-application',
	'about-us'                                                    => 'mission-and-goals',
	'contact-us'                                                  => 'contact',
);

$nsf_count = 0;
foreach ( $nsf_renames as $nsf_path => $nsf_slug ) {
	$nsf_page = get_page_by_path( $nsf_path );
	if ( ! $nsf_page ) {
		continue;
	}
	wp_update_post(
		array(
			'ID'        => $nsf_page->ID,
			'post_name' => $nsf_slug,
		)
	);
	WP_CLI::log( "/{$nsf_path}/ is now " . wp_make_link_relative( get_permalink( $nsf_page->ID ) ) );
	++$nsf_count;
}

$nsf_dupe = get_page_by_path( 'research/sleep-in-america-polls' );
if ( $nsf_dupe && get_post_meta( $nsf_dupe->ID, '_nsf_seed', true ) ) {
	wp_delete_post( $nsf_dupe->ID, true );
	WP_CLI::log( 'Deleted the duplicate /research/sleep-in-america-polls/ stub.' );
}

WP_CLI::success( sprintf( 'Renamed %d pages.', $nsf_count ) );
