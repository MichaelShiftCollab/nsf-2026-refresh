<?php
/**
 * Title: Campaign band: Drowsy Driving Prevention Week®
 * Slug: nsf/campaign-drowsy-driving
 * Categories: nsf-campaigns
 * Keywords: campaign, band, drowsy driving
 * Description: Campaign band for Drowsy Driving Prevention Week® (Figma 580:813). Replaces the Best Slept Self® band on Home in the lead-up to and during the campaign; update the dates each year.
 *
 * @package NSF
 */

echo nsf_campaign_band_markup( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the function.
	array(
		'name'    => __( 'Campaign band: Drowsy Driving Prevention Week®', 'nsf' ),
		'eyebrow' => __( 'Drowsy Driving Prevention Week®  ·  November 1–7, 2026', 'nsf' ),
		'heading' => __( 'Sleep First. Drive Alert.®', 'nsf' ),
		'text'    => __( 'Drowsy Driving Prevention Week® encourages everyone to prioritize sleep and drive when they are alert and refreshed.', 'nsf' ),
		'note'    => __( 'Drowsy driving kills an estimated 6,400 people in the U.S. every year — and nearly two-thirds of Americans report driving while drowsy.', 'nsf' ),
		'button'  => __( 'Learn more', 'nsf' ),
		'url'     => '/national-programs/drowsy-driving-prevention/',
		'variant' => 'drowsy-driving',
	)
);
