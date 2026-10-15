<?php
/**
 * Title: Statistics row
 * Slug: nsf/statistics-row
 * Categories: nsf-sections
 * Keywords: statistics, stats, numbers, key findings, facts
 * Description: Big-number grid, two across (one across on narrow screens). Used for a Resource's key findings.
 *
 * @package NSF
 */

$nsf_stats = array(
	array( '70%', __( 'of adults report some difficulty staying asleep.', 'nsf' ) ),
	array( '53%', __( 'report that the Daylight Saving Time clock change negatively affects their sleep.', 'nsf' ) ),
	array( '41%', __( 'say there is no meaningful difference in their sleep between seasons.', 'nsf' ) ),
	array( '29.5%', __( 'rank Sunday their best night for sleep.', 'nsf' ) ),
);
?>
<!-- wp:group {"metadata":{"name":"Statistics"},"className":"nsf-stats","style":{"spacing":{"blockGap":"var:preset|spacing|gutter"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"18rem"}} -->
<div class="wp-block-group nsf-stats">
<?php foreach ( $nsf_stats as $nsf_stat ) : ?>
<!-- wp:group {"metadata":{"name":"Statistic"},"className":"is-style-panel","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-panel" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"className":"nsf-stat__number","style":{"typography":{"fontWeight":"700","lineHeight":"1.1"}},"textColor":"primary-blue","fontSize":"x-large"} -->
<p class="nsf-stat__number has-primary-blue-color has-text-color has-x-large-font-size" style="font-weight:700;line-height:1.1"><?php echo esc_html( $nsf_stat[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $nsf_stat[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
