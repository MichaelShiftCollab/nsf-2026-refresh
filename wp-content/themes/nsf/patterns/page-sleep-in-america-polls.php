<?php
/**
 * Title: Page: Sleep in America® Polls
 * Slug: nsf/page-sleep-in-america-polls
 * Categories: nsf-pages
 * Post Types: page
 * Keywords: sleep in america, polls, research, reports, page
 * Description: Sleep in America® Polls page body for the "No Title" template: title band with the poll logo and a photo, recent polls as poll entries (with and without a cover), and earlier poll topics by year. Placeholder copy from the mockup.
 *
 * @package NSF
 */

/**
 * A list of earlier poll topics: year, then topic.
 *
 * @param array $items [ year, topic ] pairs.
 */
$nsf_sap_topics = function ( $items ) {
	?>
<!-- wp:list {"className":"nsf-sap-topics__list"} -->
<ul class="wp-block-list nsf-sap-topics__list"><?php foreach ( $items as $nsf_item ) : ?><!-- wp:list-item -->
<li><strong><?php echo esc_html( $nsf_item[0] ); ?></strong> <?php echo esc_html( $nsf_item[1] ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list -->

	<?php
};

$nsf_tbp = array(
	'eyebrow'  => __( 'Research', 'nsf' ),
	'heading'  => 'Sleep in America<sup>®</sup> Polls',
	'subtitle' => __( 'The Sleep in America® Poll is the National Sleep Foundation’s premier annual review of current sleep topics. The poll was first conducted in 1991.', 'nsf' ),
	'image'    => 'assets/images/home/research.jpg',
	'logo'     => 'assets/images/sleep-in-america-polls-logo.png',
	'logo_alt' => __( 'Sleep in America® Poll', 'nsf' ),
	'mark'     => 'chart',
);
require __DIR__ . '/title-band-photo.php';
?>

<!-- wp:group {"metadata":{"name":"Polls"},"align":"full","className":"is-style-section-lightest-blue nsf-sap-polls","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-sap-polls" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><?php
$nsf_polls = array(
	array(
		'year'    => '2026',
		'title'   => __( 'Sleep Health of children ages 0 to 13', 'nsf' ),
		'summary' => __( 'The 2026 Poll focused on the sleep health of American youth, specifically children ages 0 to 13. Almost everyone (95%) agrees that good sleep is essential to overall family functioning, but nearly half of parents rarely or never talk with children about the importance of sleep.', 'nsf' ),
		'button'  => __( 'Download 2026 Poll Results (PDF)', 'nsf' ),
		'link'    => __( 'Read the 2026 news release', 'nsf' ),
		'cover'   => true,
	),
	array(
		'year'    => '2025',
		'title'   => __( 'Sleep Health and Flourishing in Life', 'nsf' ),
		'summary' => __( 'The 2025 Poll explored the link between sleep health and flourishing in life. Nearly 9 in 10 adults (88%) who report good sleep satisfaction are flourishing, while less than half (47%) of those with poor sleep satisfaction experience the same level of well-being.', 'nsf' ),
		'button'  => __( 'Download 2025 Summary of Findings (PDF)', 'nsf' ),
		'link'    => __( 'Read the 2025 news release', 'nsf' ),
		'cover'   => true,
	),
	array(
		'year'    => '2024',
		'title'   => __( 'Sleep and Mental Health in Teens', 'nsf' ),
		'summary' => __( 'The 2024 Poll found that healthy sleep behaviors are closely linked to mental health in teens. Nearly 80% of teens who earn a grade of “B” or higher for practicing healthy sleep behaviors are also free of significant depressive symptoms.', 'nsf' ),
		'button'  => __( 'Download 2024 Summary of Findings (PDF)', 'nsf' ),
		'link'    => __( 'Read the 2024 news release', 'nsf' ),
		'cover'   => false,
	),
	array(
		'year'    => '2023',
		'title'   => __( 'Sleep and Mental Health', 'nsf' ),
		'summary' => __( 'The 2023 Poll shows sleep health is strongly associated with mental health in the general population.', 'nsf' ),
		'button'  => __( 'Download 2023 Summary of Findings (PDF)', 'nsf' ),
		'link'    => __( 'Read the 2023 news release', 'nsf' ),
		'cover'   => true,
	),
);
foreach ( $nsf_polls as $nsf_poll ) {
	require __DIR__ . '/poll-entry.php';
	echo "\n\n";
}
?></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Additional poll topics"},"align":"full","className":"is-style-section-white nsf-sap-topics","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-sap-topics" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:heading -->
<h2 class="wp-block-heading">Additional Sleep in America<sup>®</sup> Poll topics</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"nsf-sap-topics__grid","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-sap-topics__grid"><?php
$nsf_sap_topics(
	array(
		array( '2019', __( 'Sleep Health & Scheduling', 'nsf' ) ),
		array( '2018', __( 'Sleep and Effectiveness', 'nsf' ) ),
		array( '2015', __( 'Sleep and Pain', 'nsf' ) ),
		array( '2014', __( 'Sleep in the Modern Family', 'nsf' ) ),
		array( '2013', __( 'International Bedroom Poll', 'nsf' ) ),
		array( '2013', __( 'Exercise and Sleep', 'nsf' ) ),
		array( '2012', __( 'Transportation Workers’ Sleep', 'nsf' ) ),
	)
);
$nsf_sap_topics(
	array(
		array( '2012', __( 'Bedroom Poll', 'nsf' ) ),
		array( '2011', __( 'Technology and Sleep', 'nsf' ) ),
		array( '2011', __( 'Bedroom Poll', 'nsf' ) ),
		array( '2010', __( 'Sleep and Ethnicity', 'nsf' ) ),
		array( '2009', __( 'Health and Safety', 'nsf' ) ),
		array( '2008', __( 'Sleep, Performance and the Workplace', 'nsf' ) ),
		array( '2007', __( 'Women and Sleep', 'nsf' ) ),
	)
);
$nsf_sap_topics(
	array(
		array( '2006', __( 'Teens and Sleep', 'nsf' ) ),
		array( '2005', __( 'Adult Sleep Habits and Styles', 'nsf' ) ),
		array( '2004', __( 'Children and Sleep', 'nsf' ) ),
		array( '2003', __( 'Sleep and Aging', 'nsf' ) ),
		array( '2002', __( 'Adult Sleep Habits', 'nsf' ) ),
	)
);
?></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"nsf-sap-contact nsf-trim"} -->
<p class="nsf-sap-contact nsf-trim"><?php esc_html_e( 'For historical poll data, contact', 'nsf' ); ?> <a href="mailto:research@thensf.org">research@thensf.org</a>.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
