<?php
/**
 * Title: Campaign band: Sleep Awareness Week®
 * Slug: nsf/campaign-sleep-awareness
 * Categories: nsf-campaigns
 * Keywords: campaign, band, sleep awareness week
 * Description: Campaign band for Sleep Awareness Week® (Figma 580:826). Replaces the Best Slept Self® band on Home in the lead-up to and during the campaign; update the dates each year.
 *
 * @package NSF
 */

echo nsf_campaign_band_markup( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the function.
	array(
		'name'    => __( 'Campaign band: Sleep Awareness Week®', 'nsf' ),
		'eyebrow' => __( 'Sleep Awareness Week®  ·  March 8–14, 2026', 'nsf' ),
		'heading' => __( 'It’s time to be your Best Slept Self®', 'nsf' ),
		'text'    => __( 'It’s time to reemphasize the important connection between your sleep and your health and well-being.', 'nsf' ),
		'note'    => __( 'Nearly half of U.S. children (44%) do not consistently get the recommended amount of sleep for their age.', 'nsf' ),
		'button'  => __( 'Learn about Sleep Awareness Week', 'nsf' ),
		'url'     => '/national-programs/sleep-awareness-week/',
		'variant' => 'sleep-awareness',
	)
);
