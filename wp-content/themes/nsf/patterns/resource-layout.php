<?php
/**
 * Title: Resource layout
 * Slug: nsf/resource-layout
 * Categories: nsf-pages
 * Keywords: resource, report, key findings, related
 * Block Types: core/post-content
 * Post Types: resource
 * Description: The body of a Resource: overview (cover, download, file details, summary), key findings as a Statistics row, and Related Content. New Resources start with it.
 *
 * @package NSF
 */

require __DIR__ . '/resource-overview.php';
?>

<!-- wp:group {"metadata":{"name":"Key findings"},"align":"full","className":"is-style-section-lightest-blue","style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue" style="margin-top:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Key findings', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<?php require __DIR__ . '/statistics-row.php'; ?>

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"metadata":{"bindings":{"url":{"source":"nsf/resource","args":{"key":"file-url"}}}}} -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Download the report', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Related content"},"align":"full","style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"var:preset|spacing|60","bottom":"0"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:0"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Related content', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:nsf/related-content /--></div>
<!-- /wp:group -->
