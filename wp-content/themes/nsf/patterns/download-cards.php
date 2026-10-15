<?php
/**
 * Title: Download cards, 3-up
 * Slug: nsf/download-cards
 * Categories: nsf-sections
 * Keywords: download, pdf, infographic, report, cover, cards
 * Description: Three cards for downloads: a cover on a tinted panel, the year, the title and a "Download (PDF)" link. Replace the drawn cover with an Image block to show the real cover. Add the class is-orange to the grid for the Light Orange panel.
 *
 * @package NSF
 */

/*
 * Page patterns can require this file after setting $nsf_dl to change the
 * placeholder copy:
 * - label (string): text on the drawn cover
 * - orange (bool): Light Orange cover panels instead of Lightest Blue
 * - items (array): [ year, title, url ] per card
 */
$nsf_dl = array_merge(
	array(
		'label'  => __( 'Cover', 'nsf' ),
		'orange' => false,
		'items'  => array(
			array( '2026', __( 'Report title', 'nsf' ), '#' ),
			array( '2025', __( 'Report title', 'nsf' ), '#' ),
			array( '2024', __( 'Report title', 'nsf' ), '#' ),
		),
	),
	isset( $nsf_dl ) && is_array( $nsf_dl ) ? $nsf_dl : array()
);
$nsf_dl_class = 'nsf-dl-grid' . ( $nsf_dl['orange'] ? ' is-orange' : '' );
?>
<!-- wp:group {"metadata":{"name":"Download cards"},"className":"<?php echo esc_attr( $nsf_dl_class ); ?>","layout":{"type":"default"}} -->
<div class="wp-block-group <?php echo esc_attr( $nsf_dl_class ); ?>"><?php foreach ( $nsf_dl['items'] as $nsf_dl_item ) : ?><!-- wp:group {"metadata":{"name":"Download card"},"className":"nsf-dl-card","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-dl-card"><!-- wp:group {"className":"nsf-dl-card__media","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-dl-card__media"><!-- wp:group {"className":"nsf-dl-card__cover","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-dl-card__cover"><!-- wp:paragraph -->
<p><?php echo esc_html( $nsf_dl['label'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"nsf-dl-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-dl-card__body"><!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php echo esc_html( $nsf_dl_item[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"nsf-dl-card__title"} -->
<h3 class="wp-block-heading nsf-dl-card__title"><?php echo esc_html( $nsf_dl_item[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-dl-card__link"} -->
<p class="nsf-dl-card__link"><a href="<?php echo esc_url( $nsf_dl_item[2] ); ?>"><?php esc_html_e( 'Download (PDF)', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group -->
<?php
unset( $nsf_dl );
