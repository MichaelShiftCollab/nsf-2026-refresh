<?php
/**
 * Title: Campaign band: Best Slept Self®
 * Slug: nsf/campaign-best-slept-self
 * Categories: nsf-campaigns
 * Keywords: campaign, band, best slept self
 * Description: The default campaign band on Home. Swap it for the Drowsy Driving Prevention Week® or Sleep Awareness Week® band during those campaigns.
 *
 * @package NSF
 */

echo nsf_campaign_band_markup( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the function.
	array(
		'name'    => __( 'Campaign band: Best Slept Self®', 'nsf' ),
		'eyebrow' => __( 'Best Slept Self®', 'nsf' ),
		'heading' => __( 'What is your best slept self?', 'nsf' ),
		'text'    => __( 'A renewed you after taking small steps each day and night that make a big difference in your sleep health.', 'nsf' ),
		'note'    => __( 'Practice these six small steps for healthy sleep.', 'nsf' ),
		'button'  => __( 'See the six steps', 'nsf' ),
		'url'     => '/national-programs/best-slept-self/',
	)
);
