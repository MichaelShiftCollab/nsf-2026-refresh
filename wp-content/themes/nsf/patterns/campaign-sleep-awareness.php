<?php
/**
 * Title: Campaign band: Sleep Awareness Week®
 * Slug: nsf/campaign-sleep-awareness
 * Categories: nsf-campaigns
 * Keywords: campaign, band, sleep awareness week
 * Description: Campaign band for Sleep Awareness Week®. Placeholder copy and photos until its mockup arrives.
 *
 * @package NSF
 */

echo nsf_campaign_band_markup( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the function.
	array(
		'name'    => __( 'Campaign band: Sleep Awareness Week®', 'nsf' ),
		'eyebrow' => __( 'Sleep Awareness Week®', 'nsf' ),
		'heading' => __( 'Celebrate the benefits of sleep', 'nsf' ),
		'text'    => __( 'Each March, Sleep Awareness Week® brings people together to put sleep health first.', 'nsf' ),
		'note'    => __( 'Download the Participation Toolkit and join in.', 'nsf' ),
		'button'  => __( 'Join Sleep Awareness Week®', 'nsf' ),
		'url'     => '/national-programs/sleep-awareness-week/',
	)
);
