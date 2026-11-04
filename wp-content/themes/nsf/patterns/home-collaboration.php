<?php
/**
 * Title: Featured collaboration
 * Slug: nsf/home-collaboration
 * Categories: nsf-sections
 * Keywords: home, collaboration, partner, sponsor
 * Description: Centered: eyebrow, the partner and NSF logos with a divider, then the story, a button and the sponsorship link. Home mockup section 07 (641:1126).
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Featured collaboration"},"align":"full","className":"is-style-section-white nsf-home-section nsf-home-collab","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"960px"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-home-section nsf-home-collab" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->
<p class="has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Featured collaboration', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"metadata":{"name":"Logos"},"className":"nsf-logo-pair","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group nsf-logo-pair"><!-- wp:group {"className":"is-style-panel-outline nsf-logo-box","layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group is-style-panel-outline nsf-logo-box"><!-- wp:paragraph {"className":"is-style-eyebrow-small","textColor":"gray"} -->
<p class="is-style-eyebrow-small has-gray-color has-text-color"><?php esc_html_e( 'Partner logo', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"nsf-logo-pair__divider","backgroundColor":"light-blue"} -->
<hr class="wp-block-separator has-text-color has-light-blue-color has-alpha-channel-opacity has-light-blue-background-color has-background nsf-logo-pair__divider"/>
<!-- /wp:separator -->

<!-- wp:group {"className":"is-style-panel-outline nsf-logo-box","layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group is-style-panel-outline nsf-logo-box"><!-- wp:paragraph {"className":"is-style-eyebrow-small","textColor":"gray"} -->
<p class="is-style-eyebrow-small has-gray-color has-text-color"><?php esc_html_e( 'NSF logo', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Copy"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'IKEA U.S. and NSF reveal why Americans crave better sleep', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"is-style-paragraph-2 nsf-trim"} -->
<p class="has-text-align-center is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'National Sleep Foundation and IKEA have released a joint report sharing new insights about how Americans are sleeping — and what gets in the way of the rest they need.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/news/"><?php esc_html_e( 'Read the post  →', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"align":"center","className":"nsf-trim nsf-inline-link"} -->
<p class="has-text-align-center nsf-trim nsf-inline-link"><?php esc_html_e( 'Interested in collaborating?', 'nsf' ); ?>&nbsp; <a href="/mission-and-goals/sponsorship-opportunities/"><?php esc_html_e( 'See sponsorship opportunities', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
