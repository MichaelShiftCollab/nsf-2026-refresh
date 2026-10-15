<?php
/**
 * Title: Footer
 * Slug: nsf/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Inserter: no
 * Description: Newsletter sign-up row, then the footer: logo and tagline, utility links, 35th anniversary seal, disclaimer, copyright and social icons (Footer mockup 464:66).
 *
 * @package NSF
 */

$nsf_social = array(
	'instagram' => '#',
	'facebook'  => '#',
	'x'         => '#',
	'linkedin'  => '#',
	'youtube'   => '#',
	'bluesky'   => '#',
);
?>
<!-- wp:pattern {"slug":"nsf/newsletter-signup"} /-->

<!-- wp:group {"metadata":{"name":"Footer"},"align":"full","className":"nsf-footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0"},"blockGap":"var:preset|spacing|40"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"backgroundColor":"primary-blue","textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nsf-footer has-white-color has-primary-blue-background-color has-text-color has-background has-link-color" style="margin-top:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"metadata":{"name":"Footer top"},"className":"nsf-footer__top","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group nsf-footer__top"><!-- wp:group {"metadata":{"name":"Brand"},"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"200px","sizeSlug":"full","linkDestination":"custom","className":"nsf-footer__logo"} -->
<figure class="wp-block-image size-full is-resized nsf-footer__logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/brand/logo-nsf-white.png' ) ); ?>" alt="<?php esc_attr_e( 'National Sleep Foundation home', 'nsf' ); ?>" style="width:200px"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"italic"}}} -->
<p style="font-style:italic"><?php esc_html_e( 'The leading voice of sleep health', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:navigation {"overlayMenu":"never","className":"nsf-footer-nav","ariaLabel":"<?php esc_attr_e( 'Footer', 'nsf' ); ?>","layout":{"type":"flex","flexWrap":"wrap"}} -->
<!-- wp:navigation-link {"label":"<?php esc_attr_e( 'Contact Us', 'nsf' ); ?>","url":"/contact/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"<?php esc_attr_e( 'Terms of Use', 'nsf' ); ?>","url":"/terms-of-use/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"<?php esc_attr_e( 'Copyright', 'nsf' ); ?>","url":"/copyright/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"<?php esc_attr_e( 'Privacy Policy', 'nsf' ); ?>","url":"/privacy-policy/","kind":"custom"} /-->
<!-- /wp:navigation -->

<!-- wp:image {"width":"132px","sizeSlug":"full","linkDestination":"none","className":"nsf-footer__seal"} -->
<figure class="wp-block-image size-full is-resized nsf-footer__seal"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/brand/seal-35th.png' ) ); ?>" alt="<?php esc_attr_e( 'National Sleep Foundation: for over 35 years, established 1990', 'nsf' ); ?>" style="width:132px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"nsf-footer__rule","backgroundColor":"white"} -->
<hr class="wp-block-separator has-text-color has-white-color has-alpha-channel-opacity has-white-background-color has-background nsf-footer__rule"/>
<!-- /wp:separator -->

<!-- wp:group {"metadata":{"name":"Footer bottom"},"className":"nsf-footer__bottom","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group nsf-footer__bottom"><!-- wp:group {"metadata":{"name":"Legal"},"className":"nsf-footer__legal","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"fontSize":"x-small","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-footer__legal has-x-small-font-size"><!-- wp:paragraph -->
<p><?php esc_html_e( 'DISCLAIMER: The information on our website is provided for informational and educational purposes only. It is not a substitute for professional medical advice, diagnosis, or treatment. You should seek the advice of your physician or other qualified healthcare provider with any questions you may have regarding a health or medical condition, and treatment.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( '©2026 National Sleep Foundation. All Rights Reserved.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:social-links {"className":"is-style-logos-only nsf-footer__social","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<ul class="wp-block-social-links is-style-logos-only nsf-footer__social"><?php foreach ( $nsf_social as $nsf_service => $nsf_url ) : ?><!-- wp:social-link {"url":"<?php echo esc_url( $nsf_url ); ?>","service":"<?php echo esc_attr( $nsf_service ); ?>"} /--><?php endforeach; ?></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
