<?php
/**
 * Markup for the Campaign band patterns (Home mockup 641:1000).
 *
 * The three versions share one layout: a full-width photo strip, a white
 * card with one rounded corner on each diagonal that overlaps the strip, and
 * a round badge centered on the card's top edge. The eyebrow, heading, text,
 * note and button are centered in the card. Each version has its own badge:
 * the Best Slept Self® figure, the Drowsy Driving Prevention Week® wheel or
 * the Sleep Awareness Week® sun and moon. An editor swaps one version for
 * another by hand.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/**
 * Block markup for one Campaign band.
 *
 * @param array $band {
 *     @type string $name    Block name shown in the List View.
 *     @type string $eyebrow Eyebrow.
 *     @type string $heading H2.
 *     @type string $text    Large paragraph.
 *     @type string $note    Small paragraph under it.
 *     @type string $button  Button text.
 *     @type string $url     Button link.
 *     @type string $variant Optional: 'drowsy-driving' or 'sleep-awareness'. Default Best Slept Self®.
 * }
 * @return string
 */
function nsf_campaign_band_markup( $band ) {
	$badges  = array(
		'drowsy-driving'  => 'drowsy-driving-prevention-week/ddpw-wheel-dashed.png',
		'sleep-awareness' => 'sleep-awareness-week/sun-moon-badge.png',
	);
	$variant = $band['variant'] ?? '';
	$badge   = esc_url( get_theme_file_uri( 'assets/images/' . ( $badges[ $variant ] ?? 'home/badge-best-slept-self.png' ) ) );
	$photo   = esc_url( get_theme_file_uri( 'assets/images/home/campaign-strip.jpg' ) );
	ob_start();
	?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr( $band['name'] ); ?>"},"align":"full","className":"nsf-band","backgroundColor":"white","textColor":"gray","style":{"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|70","left":"0","right":"0"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nsf-band has-gray-color has-white-background-color has-text-color has-background" style="padding-top:0;padding-right:0;padding-bottom:var(--wp--preset--spacing--70);padding-left:0"><!-- wp:image {"align":"full","sizeSlug":"full","linkDestination":"none","className":"nsf-band__photo"} -->
<figure class="wp-block-image alignfull size-full nsf-band__photo"><img src="<?php echo $photo; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"metadata":{"name":"Card"},"className":"nsf-band__card","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group nsf-band__card"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-band__badge"} -->
<figure class="wp-block-image size-full nsf-band__badge"><img src="<?php echo $badge; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->
<p class="has-text-align-center is-style-eyebrow"><?php echo esc_html( $band['eyebrow'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html( $band['heading'] ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"is-style-paragraph-2 nsf-trim"} -->
<p class="has-text-align-center is-style-paragraph-2 nsf-trim"><?php echo esc_html( $band['text'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"nsf-trim"} -->
<p class="has-text-align-center nsf-trim"><?php echo esc_html( $band['note'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $band['url'] ); ?>"><?php echo esc_html( $band['button'] ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
	<?php
	return ob_get_clean();
}
