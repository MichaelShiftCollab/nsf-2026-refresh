<?php
/**
 * Title: Contact Us CTA
 * Slug: nsf/cta-contact-us
 * Categories: nsf-ctas
 * Keywords: contact, form, cta
 * Description: Copy beside the Contact Us form. Wireframe 489:45.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Contact Us CTA"},"align":"full","className":"is-style-section-lightest-blue","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)">
<!-- wp:nsf/cta-form {"formKey":"contact-us"} -->
<!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php esc_html_e( 'Contact Us', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Let’s connect about advancing sleep health', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Get in touch about partnering with NSF and participating in our campaigns, learn more about our scientific research and access our research data, submit media inquiries, or request more information about NSF.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-caption"} -->
<p class="is-style-caption"><?php esc_html_e( 'Fields with a * are required.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:nsf/cta-form --></div>
<!-- /wp:group -->
