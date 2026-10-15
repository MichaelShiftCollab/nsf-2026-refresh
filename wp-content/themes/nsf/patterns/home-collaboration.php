<?php
/**
 * Title: Featured collaboration
 * Slug: nsf/home-collaboration
 * Categories: nsf-sections
 * Keywords: home, collaboration, partner, sponsor
 * Description: Eyebrow, a featured partner story with links, and the partner and NSF logos. Home mockup section 07.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Featured collaboration"},"align":"full","className":"is-style-section-white","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'Featured collaboration', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|gutter"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'IKEA U.S. and NSF reveal why Americans crave better sleep', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'National Sleep Foundation and IKEA have released a joint report sharing new insights about how Americans are sleeping — and what gets in the way of the rest they need.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link nsf-trim"} -->
<p class="is-style-link nsf-trim"><a href="/news/"><?php esc_html_e( 'Read the post', 'nsf' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-trim nsf-inline-link"} -->
<p class="nsf-trim nsf-inline-link"><?php esc_html_e( 'Interested in collaborating?', 'nsf' ); ?>  <a href="/sponsorship-opportunities/"><?php esc_html_e( 'Sponsorship opportunities', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"480px"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:480px"><!-- wp:group {"metadata":{"name":"Logos"},"className":"nsf-logo-pair","style":{"spacing":{"blockGap":"var:preset|spacing|gutter"}},"layout":{"type":"grid","columnCount":2}} -->
<div class="wp-block-group nsf-logo-pair"><!-- wp:group {"className":"is-style-panel-outline nsf-logo-box","layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group is-style-panel-outline nsf-logo-box"><!-- wp:paragraph {"className":"is-style-eyebrow-small","textColor":"gray"} -->
<p class="is-style-eyebrow-small has-gray-color has-text-color"><?php esc_html_e( 'Partner logo', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-panel-outline nsf-logo-box","layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group is-style-panel-outline nsf-logo-box"><!-- wp:paragraph {"className":"is-style-eyebrow-small","textColor":"gray"} -->
<p class="is-style-eyebrow-small has-gray-color has-text-color"><?php esc_html_e( 'NSF logo', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
