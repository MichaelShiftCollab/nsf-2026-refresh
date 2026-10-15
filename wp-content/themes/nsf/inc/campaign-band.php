<?php
/**
 * Markup for the Campaign band patterns (Home mockup 473:60 and 464:121).
 *
 * The three versions share one layout: copy and a button on the left, a
 * cluster of three photos over a faded watermark on the right. An editor
 * swaps one version for another by hand.
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
 * }
 * @return string
 */
function nsf_campaign_band_markup( $band ) {
	$image = fn( $file ) => esc_url( get_theme_file_uri( 'assets/images/home/' . $file ) );
	ob_start();
	?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr( $band['name'] ); ?>"},"align":"full","className":"is-style-section-light-blue-to-light-orange nsf-band","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-light-blue-to-light-orange nsf-band" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:columns {"verticalAlignment":"center","className":"nsf-band__columns","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|70"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center nsf-band__columns"><!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php echo esc_html( $band['eyebrow'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html( $band['heading'] ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php echo esc_html( $band['text'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php echo esc_html( $band['note'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $band['url'] ); ?>"><?php echo esc_html( $band['button'] ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"568px"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:568px"><!-- wp:group {"metadata":{"name":"Photo cluster"},"className":"nsf-photo-cluster","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-photo-cluster"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-photo-cluster__large"} -->
<figure class="wp-block-image size-full nsf-photo-cluster__large"><img src="<?php echo $image( 'campaign-large.jpg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-photo-cluster__right"} -->
<figure class="wp-block-image size-full nsf-photo-cluster__right"><img src="<?php echo $image( 'campaign-small-right.jpg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-photo-cluster__left"} -->
<figure class="wp-block-image size-full nsf-photo-cluster__left"><img src="<?php echo $image( 'campaign-small-left.jpg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
	<?php
	return ob_get_clean();
}
