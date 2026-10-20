<?php
/**
 * Title: Campaign band: Drowsy Driving Prevention Week®
 * Slug: nsf/campaign-drowsy-driving
 * Categories: nsf-campaigns
 * Keywords: campaign, band, drowsy driving
 * Description: Campaign band for Drowsy Driving Prevention Week®. Placeholder copy and photos until its mockup arrives.
 *
 * @package NSF
 */

echo nsf_campaign_band_markup( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the function.
	array(
		'name'    => __( 'Campaign band: Drowsy Driving Prevention Week®', 'nsf' ),
		'eyebrow' => __( 'Drowsy Driving Prevention Week®', 'nsf' ),
		'heading' => __( 'Stay awake at the wheel', 'nsf' ),
		'text'    => __( 'Drowsy driving puts everyone on the road at risk. Learn the warning signs and how to plan ahead for alert driving.', 'nsf' ),
		'note'    => __( 'Find events, toolkits and resources for this year’s campaign.', 'nsf' ),
		'button'  => __( 'Get involved', 'nsf' ),
		'url'     => '/national-programs/drowsy-driving-prevention/',
	)
);
