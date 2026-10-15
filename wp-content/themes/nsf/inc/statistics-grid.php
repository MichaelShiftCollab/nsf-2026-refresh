<?php
/**
 * Statistics grid: Statistic panels, each a big number over a line of text.
 * Used by the Statistics row patterns and the Resource layout.
 *
 * Expects $nsf_stats (array of [number, text]) and $nsf_columns.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

?>
<!-- wp:group {"metadata":{"name":"Statistics"},"className":"nsf-stats","style":{"spacing":{"blockGap":"var:preset|spacing|gutter"}},"layout":{"type":"grid","columnCount":<?php echo (int) $nsf_columns; ?>,"minimumColumnWidth":"<?php echo 4 === (int) $nsf_columns ? '15rem' : '18rem'; ?>"}} -->
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
<!-- /wp:group -->
