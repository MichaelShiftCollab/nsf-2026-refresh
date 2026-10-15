<?php
/**
 * Title: Title band with contact box
 * Slug: nsf/title-band-contact
 * Categories: nsf-sections
 * Keywords: title, heading, banner, contact, media, press
 * Description: Page heading and intro on the Inner Page Heading gradient, with a white contact box on the right that overlaps the band's sheet. Media Center mockup. For pages on the "No Title" template.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Title band with contact box"},"align":"full","className":"is-style-section-title-band nsf-title-band nsf-title-band-contact","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-title-band nsf-title-band nsf-title-band-contact"><!-- wp:group {"className":"nsf-title-band-contact__split","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-title-band-contact__split"><!-- wp:group {"className":"nsf-title-band-contact__copy","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group nsf-title-band-contact__copy"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html__( 'Media Center', 'nsf' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2"} -->
<p class="is-style-paragraph-2"><?php echo esc_html__( 'Intro paragraph — one or two sentences on who this page is for and how journalists can work with NSF.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"tagName":"aside","className":"nsf-contact-box","layout":{"type":"default"}} -->
<aside class="wp-block-group nsf-contact-box"><!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php echo esc_html__( 'Media contact', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-contact-box__name"} -->
<p class="nsf-contact-box__name"><?php echo esc_html__( 'Contact name', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-contact-box__title"} -->
<p class="nsf-contact-box__title"><?php echo esc_html__( 'Title', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-contact-box__email"} -->
<p class="nsf-contact-box__email"><a href="#"><?php echo esc_html__( 'Email address', 'nsf' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-contact-box__phone"} -->
<p class="nsf-contact-box__phone"><?php echo esc_html__( 'Phone number', 'nsf' ); ?></p>
<!-- /wp:paragraph --></aside>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
