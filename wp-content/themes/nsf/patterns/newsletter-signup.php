<?php
/**
 * Title: Newsletter sign-up row
 * Slug: nsf/newsletter-signup
 * Categories: nsf-sections
 * Keywords: newsletter, sign up, email, stay connected
 * Description: The Stay Connected row above the footer on every page (Sign up mockup 464:36). It lives in the footer template part, so editing it there changes every page.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Newsletter sign-up"},"align":"full","className":"is-style-section-light-orange-to-white nsf-signup","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","contentSize":"800px"}} -->
<div class="wp-block-group alignfull is-style-section-light-orange-to-white nsf-signup" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Copy"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->
<p class="has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Stay connected', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Tap into our sleep health content', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"is-style-paragraph-2 nsf-trim"} -->
<p class="has-text-align-center is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'Sign up for sleep health news from NSF, and join the discussion on social — our latest findings, guidelines and campaign updates.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Form"},"className":"nsf-signup__form","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained","contentSize":"600px"}} -->
<div class="wp-block-group nsf-signup__form"><!-- wp:nsf/form {"formKey":"newsletter","layout":"inline"} /-->

<!-- wp:paragraph {"align":"center","className":"is-style-caption nsf-trim"} -->
<p class="has-text-align-center is-style-caption nsf-trim"><?php esc_html_e( 'We’ll never share your email address.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
