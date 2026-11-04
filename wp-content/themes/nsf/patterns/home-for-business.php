<?php
/**
 * Title: For business
 * Slug: nsf/home-for-business
 * Categories: nsf-sections
 * Keywords: home, business, sleepmark, sleeptech
 * Description: Eyebrow, heading, the SleepMark® panel with its lead form and the SleepTech® Network panel. Home mockup section 06.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"For business"},"align":"full","className":"is-style-section-primary-blue-to-dark-blue nsf-home-section nsf-home-business","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-primary-blue-to-dark-blue nsf-home-section nsf-home-business" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained","contentSize":"840px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-eyebrow","textColor":"primary-orange"} -->
<p class="is-style-eyebrow has-primary-orange-color has-text-color"><?php esc_html_e( 'For business', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Independent, evidence-based validation for brands and innovators', 'nsf' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Panels"},"style":{"spacing":{"blockGap":"var:preset|spacing|gutter"}},"className":"nsf-business-panels","layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"20rem"}} -->
<div class="wp-block-group nsf-business-panels"><!-- wp:group {"metadata":{"name":"SleepMark®"},"className":"is-style-panel","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-panel"><!-- wp:image {"width":"104px","height":"104px","sizeSlug":"full","linkDestination":"none","className":"nsf-business-logo"} -->
<figure class="wp-block-image size-full is-resized nsf-business-logo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/brand/logo-sleepmark.png' ) ); ?>" alt="<?php esc_attr_e( 'SleepMark® seal', 'nsf' ); ?>" style="width:104px;height:104px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'SleepMark®', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'Certification for workplaces and consumer sleep products, evaluated against NSF’s evidence-based criteria.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-dot"} -->
<ul class="wp-block-list is-style-dot"><!-- wp:list-item -->
<li><?php esc_html_e( 'Criteria rooted in peer-reviewed guidelines and expert standards', 'nsf' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'A rigorous review against objective scoring criteria', 'nsf' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'An independent designation consumers can recognize', 'nsf' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:paragraph {"className":"is-style-eyebrow-small","textColor":"primary-blue"} -->
<p class="is-style-eyebrow-small has-primary-blue-color has-text-color"><?php esc_html_e( 'Request information', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:nsf/form {"formKey":"sleepmark-lead","linkText":"<?php esc_attr_e( 'See the application process', 'nsf' ); ?>","url":"/sleepmark/"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"SleepTech® Network"},"className":"is-style-panel","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-panel"><!-- wp:image {"width":"104px","height":"104px","sizeSlug":"full","linkDestination":"none","className":"nsf-business-logo"} -->
<figure class="wp-block-image size-full is-resized nsf-business-logo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/brand/logo-sleeptech.png' ) ); ?>" alt="<?php esc_attr_e( 'SleepTech® logo', 'nsf' ); ?>" style="width:104px;height:104px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'SleepTech® Network', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'Membership, standards and recognition for organizations bringing sleep science into products and services.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-dot"} -->
<ul class="wp-block-list is-style-dot"><!-- wp:list-item -->
<li><?php esc_html_e( 'SleepTech® Network membership and member resources', 'nsf' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Standards development with CTA and ANSI', 'nsf' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Validation studies using NSF’s research tools', 'nsf' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'SleepTech® Award — annual recognition in two categories', 'nsf' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:group {"metadata":{"name":"Actions"},"className":"nsf-actions","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group nsf-actions"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/about-sleeptech/sleeptech-network/membership-application/"><?php esc_html_e( 'Join the network', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"className":"is-style-link nsf-trim"} -->
<p class="is-style-link nsf-trim"><a href="/about-sleeptech/sleeptech-award/"><?php esc_html_e( 'Apply for the award', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
