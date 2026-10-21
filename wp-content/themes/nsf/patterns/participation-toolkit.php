<?php
/**
 * Title: Participation Toolkit
 * Slug: nsf/participation-toolkit
 * Categories: nsf-ctas
 * Keywords: sleep awareness week, toolkit, form
 * Description: Heading and text beside the Participation Toolkit form, on Light Orange (mockup 505:386). Used on the Sleep Awareness Week® page.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Participation Toolkit"},"align":"full","className":"is-style-section-light-orange nsf-saw-toolkit","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-light-orange nsf-saw-toolkit" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)">
<!-- wp:nsf/cta-form {"formKey":"participation-toolkit","eyebrow":"<?php echo esc_attr__( 'Request the toolkit', 'nsf' ); ?>","stackFields":true} -->
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Sleep Awareness Week® Participation Toolkit', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'Help everyone be their Best Slept Self.® Share sleep health resources with friends, family and colleagues. Complete the form to get the Participation Toolkit — we’ll reach out after the campaign to see how you used the materials.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:nsf/cta-form --></div>
<!-- /wp:group -->
