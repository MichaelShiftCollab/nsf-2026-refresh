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
	$text     = $content ? $content : 'Placeholder copy for ' . $title . '. Sleep health information and resources from the National Sleep Foundation.';
	// WordPress installs a draft Privacy Policy page; publish it as a stub so the footer link works.
	if ( $existing && 'draft' === $existing->post_status && (int) get_option( 'wp_page_for_privacy_policy' ) === $existing->ID ) {
		wp_update_post(
			array(
				'ID'           => $existing->ID,
				'post_status'  => 'publish',
				'post_title'   => $title,
				'post_excerpt' => $text,
				'post_content' => '<!-- wp:paragraph --><p>' . esc_html( $text ) . '</p><!-- /wp:paragraph -->',
				'meta_input'   => array( '_nsf_seed' => 1 ),
			)
		);
	}
	if ( $existing ) {
		return $existing->ID;
	}
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

// Every page in content/site-outline.md, parents first. Pages that pair with an
// old-site page keep its slug, from the content plan (docs/decisions.md, October 20).
$nsf_outline = array(
	'national-programs'                                                => array( 'National Programs' ),
	'national-programs/sleep-awareness-week'                           => array( 'Sleep Awareness Week®', 'NSF’s annual campaign to celebrate sleep health and help everyone sleep better.' ),
	'national-programs/drowsy-driving-prevention'                      => array( 'Drowsy Driving Prevention Week®', 'Sleep First. Drive Alert.® NSF’s annual campaign encourages everyone to prioritize sleep and drive when they are alert and refreshed.' ),
	'national-programs/drowsy-driving-prevention/drowsy-driving-prevention-resources' => array( 'Drowsy Driving Prevention Resources' ),
	'national-programs/best-slept-self'                                => array( 'Best Slept Self®', 'Simple steps to sleep well and be your best slept self.' ),
	'national-programs/employee-wellness'                              => array( 'Reshaping Employee Wellness' ),
	'national-programs/issues'                                         => array( 'Key Issues' ),
	'sleep-health-resources'                                           => array( 'Sleep Health Resources' ),
	'sleep-health-resources/sleep-health-topics'                       => array( 'Sleep Learning Zone®' ),
	'research'                                                         => array( 'Research' ),
	'research/nsf-sleep-measures'                                      => array( 'NSF Sleep Measures' ),
	'research/nsf-sleep-measures/sleep-health-index'                   => array( 'Sleep Health Index®' ),
	'research/nsf-sleep-measures/sst'                                  => array( 'Sleep Satisfaction Tool®' ),
	'research/nsf-sleep-measures/bssq'                                 => array( 'Best Slept Self® Questionnaire' ),
	'research/nsf-publications'                                        => array( 'NSF Publications' ),
	'research/nsf-publications/foundations-of-sleep-health'            => array( 'Foundations of Sleep Health™' ),
	'research/nsf-publications/sleep-health-journal'                   => array( 'Sleep Health®: Journal of the National Sleep Foundation' ),
	'research/nsf-publications/guidelines'                             => array( 'Guidelines' ),
	'research/nsf-publications/position-statements'                    => array( 'Position Statements' ),
	'research/nsf-research-reports'                                    => array( 'NSF Research Reports' ),
	'research/nsf-research-reports/sleep-in-america-polls'             => array( 'Sleep in America® Polls', 'NSF’s annual poll on how Americans sleep, from drowsy driving to family sleep habits.' ),
	'research/nsf-research-reports/drowsy-driving-reports'             => array( 'Drowsy Driving Reports' ),
	'research/nsf-research-reports/sleepapneasurvey'                   => array( 'Understanding Sleep Apnea' ),
	'research/nsf-research-reports/sleep-health-during-a-presidential-election' => array( 'Sleep Health During a Presidential Election' ),
	'research/nsf-research-reports/sleep-health-and-the-covid-19-pandemic' => array( 'Sleep Health and the COVID-19 Pandemic' ),
	'research/nsf-research-reports/topical-reports'                    => array( 'Topical Reports' ),
	'about-sleeptech'                                                  => array( 'SleepTech®' ),
	'about-sleeptech/nsf-cta-ansi-standards'                           => array( 'NSF / CTA / ANSI Standards' ),
	'about-sleeptech/sleeptech-network'                                => array( 'SleepTech® Network' ),
	'about-sleeptech/sleeptech-network/membership-application'         => array( 'SleepTech® Network Membership' ),
	'about-sleeptech/sleeptech-award'                                  => array( 'SleepTech® Award' ),
	'sleepmark'                                                        => array( 'SleepMark®' ),
	'sleepmark/sleepmark-application'                                  => array( 'SleepMark® Application' ),
	'media-center'                                                     => array( 'Media Center' ),
	'mission-and-goals'                                                => array( 'About Us' ),
	'mission-and-goals/boards-and-committees'                          => array( 'Boards and Committees' ),
	'mission-and-goals/lifetime-achievement-award'                     => array( 'Lifetime Achievement Award' ),
	'mission-and-goals/sponsorship-opportunities'                      => array( 'Sponsorship Opportunities' ),
	'contact'                                                          => array( 'Contact Us' ),
	'terms-of-use'                                                     => array( 'Terms of Use' ),
	'copyright'                                                        => array( 'Copyright' ),
	'privacy-policy'                                                   => array( 'Privacy Policy' ),
);
$nsf_ids = array();
foreach ( $nsf_outline as $nsf_path => $nsf_page ) {
	$nsf_parent           = dirname( $nsf_path );
	$nsf_ids[ $nsf_path ] = nsf_stub_page( $nsf_page[0], basename( $nsf_path ), '.' === $nsf_parent ? 0 : $nsf_ids[ $nsf_parent ], $nsf_page[1] ?? '' );
}
$nsf_blog = $nsf_ids['sleep-health-resources/sleep-health-topics'];

// The posts page only takes effect with a static front page.
if ( 'page' !== get_option( 'show_on_front' ) || ! get_option( 'page_on_front' ) ) {
	update_option( 'page_on_front', nsf_stub_page( 'Home', 'home' ) );
	update_option( 'show_on_front', 'page' );
}
update_option( 'page_for_posts', $nsf_blog );
WP_CLI::success( 'Listing pages ready. Posts page: ' . get_permalink( $nsf_blog ) );
