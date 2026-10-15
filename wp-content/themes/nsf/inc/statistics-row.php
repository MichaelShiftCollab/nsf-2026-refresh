<?php
/**
 * Statistics row markup shared by the 2- and 4-across patterns: a heading
 * and a grid of Statistic panels, each a big number over a line of text.
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

<!-- wp:group {"metadata":{"name":"Statistics"},"className":"nsf-stats","style":{"spacing":{"blockGap":"var:preset|spacing|gutter"}},"layout":{"type":"grid","columnCount":<?php echo (int) $nsf_columns; ?>,"minimumColumnWidth":"<?php echo 4 === (int) $nsf_columns ? '12rem' : '18rem'; ?>"}} -->
<div class="wp-block-group nsf-stats">
<?php foreach ( $nsf_stats as $nsf_stat ) : ?>
<!-- wp:group {"className":"is-style-stat","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-stat"><!-- wp:paragraph {"className":"is-style-stat-number nsf-trim"} -->
<p class="is-style-stat-number nsf-trim"><?php echo esc_html( $nsf_stat[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $nsf_stat[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group --></div>
<!-- /wp:group -->
