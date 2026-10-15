<?php
/**
 * Title: Flexible CTA with Link
 * Slug: nsf/cta-link
 * Categories: nsf-ctas
 * Keywords: cta, donate, link, button
 * Description: Eyebrow, heading, copy and a button link, for example to the donation page.
 *
 * @package NSF
 */

?>
<!-- wp:nsf/cta-link -->
<!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php esc_html_e( 'Support NSF', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Help everyone be their Best Slept Self®', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Your gift funds sleep research and public education that helps people sleep better, live healthier and stay safe on the road.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/donate/"><?php esc_html_e( 'Donate', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- /wp:nsf/cta-link -->
