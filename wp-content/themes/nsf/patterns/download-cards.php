<?php
/**
 * Title: Download cards, 3-up
 * Slug: nsf/download-cards
 * Categories: nsf-sections
 * Keywords: download, pdf, infographic, report, cover, cards
 * Description: Three outlined cards for downloads: a cover image or photo, the year, the title and a "Download (PDF)" link. Without an image the card shows a drawn cover on a tinted panel. Add the class is-contain to the grid for illustrations on Lightest Blue, or is-orange for the Light Orange panel.
 *
 * @package NSF
 */

/*
 * Page patterns can require this file after setting $nsf_dl to change the
 * placeholder copy:
 * - label (string): text on the drawn cover
 * - orange (bool): Light Orange cover panels instead of Lightest Blue
 * - contain (bool): show the images whole on Lightest Blue (illustrations)
 * - items (array): [ year, title, url, image ] per card; image is a theme
 *   path, '' for the drawn cover
 */
$nsf_dl = array_merge(
	array(
		'label'   => __( 'Cover', 'nsf' ),
		'orange'  => false,
		'contain' => false,
		'items'   => array(
			array( '2026', __( 'Report title', 'nsf' ), '#', '' ),
			array( '2025', __( 'Report title', 'nsf' ), '#', '' ),
			array( '2024', __( 'Report title', 'nsf' ), '#', '' ),
		),
	),
	isset( $nsf_dl ) && is_array( $nsf_dl ) ? $nsf_dl : array()
);
$nsf_dl_class = 'nsf-dl-grid' . ( $nsf_dl['orange'] ? ' is-orange' : '' ) . ( $nsf_dl['contain'] ? ' is-contain' : '' );
?>
<!-- wp:group {"metadata":{"name":"Download cards"},"className":"<?php echo esc_attr( $nsf_dl_class ); ?>","layout":{"type":"default"}} -->
<div class="wp-block-group <?php echo esc_attr( $nsf_dl_class ); ?>"><?php foreach ( $nsf_dl['items'] as $nsf_dl_item ) : ?><!-- wp:group {"metadata":{"name":"Download card"},"className":"nsf-dl-card","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-dl-card"><?php if ( ! empty( $nsf_dl_item[3] ) ) : ?><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-dl-card__image"} -->
<figure class="wp-block-image size-full nsf-dl-card__image"><img src="<?php echo esc_url( get_theme_file_uri( $nsf_dl_item[3] ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
<?php else : ?><!-- wp:group {"className":"nsf-dl-card__media","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-dl-card__media"><!-- wp:group {"className":"nsf-dl-card__cover","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-dl-card__cover"><!-- wp:paragraph -->
<p><?php echo esc_html( $nsf_dl['label'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<?php endif; ?>

<!-- wp:group {"className":"nsf-dl-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-dl-card__body"><!-- wp:group {"className":"nsf-dl-card__top","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-dl-card__top"><!-- wp:paragraph {"className":"is-style-eyebrow-small nsf-trim"} -->
<p class="is-style-eyebrow-small nsf-trim"><?php echo esc_html( $nsf_dl_item[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"nsf-dl-card__title nsf-trim"} -->
<h3 class="wp-block-heading nsf-dl-card__title nsf-trim"><?php echo esc_html( $nsf_dl_item[1] ); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"nsf-dl-card__link nsf-trim"} -->
<p class="nsf-dl-card__link nsf-trim"><a href="<?php echo esc_url( $nsf_dl_item[2] ); ?>"><?php esc_html_e( 'Download (PDF)', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group -->
<?php
unset( $nsf_dl );
