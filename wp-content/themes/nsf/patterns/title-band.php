<?php
/**
 * Title: Title band
 * Slug: nsf/title-band
 * Categories: nsf-sections
 * Keywords: title, heading, banner, breadcrumbs, hero
 * Description: Breadcrumbs, an optional eyebrow, the page heading and a subtitle on the Inner Page Heading gradient. For pages on the "No Title" template whose heading differs from the page title.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Title band"},"align":"full","className":"is-style-section-title-band nsf-title-band","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-title-band nsf-title-band"><!-- wp:nsf/breadcrumbs /-->

<!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php echo esc_html__( 'Eyebrow', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html__( 'Page heading', 'nsf' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2"} -->
<p class="is-style-paragraph-2"><?php echo esc_html__( 'One or two sentences under the heading.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
