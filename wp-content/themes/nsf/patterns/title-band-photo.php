<?php
/**
 * Title: Title band with photo
 * Slug: nsf/title-band-photo
 * Categories: nsf-sections
 * Keywords: title, heading, banner, hero, photo, logo, eyebrow
 * Description: Hero with a photo beside the copy on the Light Blue to Light Orange gradient: an optional logo, an eyebrow, the page heading and an intro, then a photo with two rounded corners over a faded shape. For pages on the "No Title" template. Add the class is-mark-chart or is-mark-wheel for the shape behind the photo.
 *
 * @package NSF
 */

/*
 * Page patterns can require this file after setting $nsf_tbp to change the
 * placeholder copy and options:
 * - eyebrow (string, empty to leave out), heading, subtitle, image (theme path)
 * - logo (string): theme path of a logo above the eyebrow ('' for none)
 * - logo_alt (string): the logo's alt text
 * - mark (string): 'chart' or 'wheel', the faded shape behind the photo
 * - crumbs (bool): breadcrumbs above the eyebrow
 */
$nsf_tbp = array_merge(
	array(
		'eyebrow'  => __( 'Eyebrow', 'nsf' ),
		'heading'  => __( 'Page heading', 'nsf' ),
		'subtitle' => __( 'One or two sentences under the heading.', 'nsf' ),
		'image'    => 'assets/images/home/hero-1.jpg',
		'logo'     => '',
		'logo_alt' => '',
		'mark'     => 'wheel',
		'crumbs'   => false,
	),
	isset( $nsf_tbp ) && is_array( $nsf_tbp ) ? $nsf_tbp : array()
);

$nsf_tbp_class   = 'is-style-section-light-blue-to-light-orange nsf-band nsf-tbp'
	. ( $nsf_tbp['mark'] ? ' is-mark-' . $nsf_tbp['mark'] : '' );
$nsf_tbp_heading = wp_kses( $nsf_tbp['heading'], array( 'sup' => array() ) );
?>
<!-- wp:group {"metadata":{"name":"Title band with photo"},"align":"full","className":"<?php echo esc_attr( $nsf_tbp_class ); ?>","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull <?php echo esc_attr( $nsf_tbp_class ); ?>" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-tbp__split","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-tbp__split"><!-- wp:group {"className":"nsf-tbp__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-tbp__copy"><?php if ( $nsf_tbp['crumbs'] ) : ?><!-- wp:nsf/breadcrumbs /-->

<?php endif; ?><?php if ( $nsf_tbp['logo'] ) : ?><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-tbp__logo"} -->
<figure class="wp-block-image size-full nsf-tbp__logo"><img src="<?php echo esc_url( get_theme_file_uri( $nsf_tbp['logo'] ) ); ?>" alt="<?php echo esc_attr( $nsf_tbp['logo_alt'] ); ?>"/></figure>
<!-- /wp:image -->

<?php endif; ?><?php if ( $nsf_tbp['eyebrow'] ) : ?><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php echo esc_html( $nsf_tbp['eyebrow'] ); ?></p>
<!-- /wp:paragraph -->

<?php endif; ?><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo $nsf_tbp_heading; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_kses above. ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-tbp__lead"} -->
<p class="is-style-paragraph-2 nsf-tbp__lead"><?php echo esc_html( $nsf_tbp['subtitle'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"nsf-tbp__media","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-tbp__media"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-tbp__photo nsf-photo"} -->
<figure class="wp-block-image size-full nsf-tbp__photo nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( $nsf_tbp['image'] ) ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<?php
unset( $nsf_tbp );
