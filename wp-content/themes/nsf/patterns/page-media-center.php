<?php
/**
 * Title: Media Center page
 * Slug: nsf/page-media-center
 * Categories: nsf-pages
 * Post Types: page
 * Keywords: media, press, news, experts
 * Description: The whole Media Center page (use the "No Title" template): title band with the media contact box, Key facts, experts available for interview, press mentions and press releases with Load more.
 *
 * @package NSF
 */

require __DIR__ . '/title-band-contact.php';

$nsf_stats   = array_fill( 0, 4, array( 'XX', __( 'Key fact — one short sentence describing the figure.', 'nsf' ) ) );
$nsf_columns = 4;
?>
<!-- wp:group {"metadata":{"name":"Key facts"},"align":"full","className":"is-style-section-white nsf-media-key-facts","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-media-key-facts" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Key facts', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<?php require __DIR__ . '/../inc/statistics-grid.php'; ?>
</div>
<!-- /wp:group -->
<?php

require __DIR__ . '/media-experts.php';
require __DIR__ . '/press-mentions.php';
require __DIR__ . '/press-releases.php';
