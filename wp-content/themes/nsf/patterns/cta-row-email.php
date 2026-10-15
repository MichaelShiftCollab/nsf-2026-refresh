<?php
/**
 * Title: General CTA Row, email
 * Slug: nsf/cta-row-email
 * Categories: nsf-ctas
 * Keywords: cta, call to action, button, email
 * Description: Heading, one line of copy and a button that sends an email: link it to mailto: and the address. Wireframe 489:204.
 *
 * @package NSF
 */

?>
<!-- wp:nsf/cta-row -->
<!-- wp:group {"className":"nsf-cta-row__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-cta-row__copy"><!-- wp:heading {"className":"is-style-card-heading"} -->
<h2 class="wp-block-heading is-style-card-heading"><?php esc_html_e( 'Call to action heading', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'One line of supporting copy.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="mailto:"><?php esc_html_e( 'Email us', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- /wp:nsf/cta-row -->
