<?php
/**
 * Title: SleepTech® Network Membership page
 * Slug: nsf/page-sleeptech-network-membership
 * Categories: nsf-pages
 * Post Types: page
 * Keywords: sleeptech, network, membership, application, form
 * Description: The whole SleepTech® Network Membership page body (default template): intro copy, then Join the Network with the membership application. The application is the NSF Form block with the SleepTech® Network Membership form.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Intro"},"align":"full","className":"is-style-section-white nsf-membership-intro","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-membership-intro" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"820px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-paragraph-2","textColor":"primary-blue"} -->
<p class="is-style-paragraph-2 has-primary-blue-color has-text-color"><?php echo esc_html__( 'The National Sleep Foundation’s SleepTech® Network is a community platform for industry innovators and leaders dedicated to advancing technology’s promise for sleep health.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-membership-intro__text"} -->
<p class="nsf-membership-intro__text"><?php echo esc_html__( 'By joining the network, companies receive evidence-based and consensus-driven recommendations, standards, and content from NSF that can help today’s technology designers, developers, and manufacturers who are working to help improve people’s sleep.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-membership-intro__text"} -->
<p class="nsf-membership-intro__text"><?php echo esc_html__( 'Joining the network is easy. Complete the membership application below.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Join the Network"},"align":"full","className":"is-style-section-lightest-blue nsf-band nsf-membership-join","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-band nsf-membership-join" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Join the Network', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"820px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"is-style-panel nsf-membership-form","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-panel nsf-membership-form"><!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php echo esc_html__( 'Membership application', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:nsf/form {"formKey":"sleeptech-network-membership"} /-->
</div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
