<?php
/**
 * Title: Title band with photo
 * Slug: nsf/title-band-photo
 * Categories: nsf-sections
 * Keywords: title, heading, banner, breadcrumbs, hero, photo
 * Description: Title band with a photo beside the copy: breadcrumbs, an optional eyebrow, the page heading and a subtitle on the Inner Page Heading gradient. For pages on the "No Title" template. Add the class has-lightest-blue-sheet when the next section is Lightest Blue, and has-photo-overlap to let the photo hang over the sheet.
 *
 * @package NSF
 */

/*
 * Page patterns can require this file after setting $nsf_tbp to change the
 * placeholder copy and options:
 * - eyebrow (string, empty to leave out), heading, subtitle, image (theme path)
 * - crumbs_above (bool): breadcrumbs above the copy and photo, not in the copy
 * - overlap (bool): the photo starts at the top and hangs over the sheet
 * - sheet (string): '' (white) or 'lightest-blue'
 * - lead_class (string): class for the subtitle paragraph
 */
$nsf_tbp = array_merge(
	array(
		'eyebrow'      => __( 'Eyebrow', 'nsf' ),
		'heading'      => __( 'Page heading', 'nsf' ),
		'subtitle'     => __( 'One or two sentences under the heading.', 'nsf' ),
		'image'        => 'assets/images/home/hero-1.jpg',
		'crumbs_above' => false,
		'overlap'      => false,
		'sheet'        => '',
		'lead_class'   => 'is-style-paragraph-2',
	),
	isset( $nsf_tbp ) && is_array( $nsf_tbp ) ? $nsf_tbp : array()
);

$nsf_tbp_class = 'is-style-section-title-band nsf-title-band nsf-tbp'
	. ( $nsf_tbp['sheet'] ? ' has-' . $nsf_tbp['sheet'] . '-sheet' : '' )
	. ( $nsf_tbp['overlap'] ? ' has-photo-overlap' : '' );
$nsf_tbp_heading = wp_kses( $nsf_tbp['heading'], array( 'sup' => array() ) );

$nsf_tbp_crumbs = '<!-- wp:nsf/breadcrumbs /-->';
?>
<!-- wp:group {"metadata":{"name":"Title band with photo"},"align":"full","className":"<?php echo esc_attr( $nsf_tbp_class ); ?>","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull <?php echo esc_attr( $nsf_tbp_class ); ?>"><?php if ( $nsf_tbp['crumbs_above'] ) : ?><?php echo $nsf_tbp_crumbs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

<?php endif; ?><!-- wp:group {"className":"nsf-tbp__split","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-tbp__split"><!-- wp:group {"className":"nsf-tbp__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-tbp__copy"><?php if ( ! $nsf_tbp['crumbs_above'] ) : ?><?php echo $nsf_tbp_crumbs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

<?php endif; ?><?php if ( $nsf_tbp['eyebrow'] ) : ?><!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php echo esc_html( $nsf_tbp['eyebrow'] ); ?></p>
<!-- /wp:paragraph -->

<?php endif; ?><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo $nsf_tbp_heading; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_kses above. ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"<?php echo esc_attr( $nsf_tbp['lead_class'] ); ?>"} -->
<p class="<?php echo esc_attr( $nsf_tbp['lead_class'] ); ?>"><?php echo esc_html( $nsf_tbp['subtitle'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-tbp__photo nsf-photo"} -->
<figure class="wp-block-image size-full nsf-tbp__photo nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( $nsf_tbp['image'] ) ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<?php
unset( $nsf_tbp );
