<?php
/**
 * Statistics row markup shared by the 2- and 4-across patterns: a heading
 * over the Statistics grid.
 *
 * Expects $nsf_heading, $nsf_stats (array of [number, text]) and $nsf_columns.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

?>
<!-- wp:group {"metadata":{"name":"Statistics row"},"align":"full","className":"is-style-section-white","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html( $nsf_heading ); ?></h2>
<!-- /wp:heading -->

<?php require __DIR__ . '/statistics-grid.php'; ?>
</div>
<!-- /wp:group -->
