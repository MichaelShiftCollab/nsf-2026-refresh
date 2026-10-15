<?php
/**
 * Title: Resource overview
 * Slug: nsf/resource-overview
 * Categories: nsf-sections
 * Keywords: resource, report, download, cover, summary
 * Description: The Resource's featured image as its cover, a download button and file details (type, size, pages) on the left; the summary on the right. The button and file details come from the Resource's file and hide when it has none or is gated.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Overview"},"align":"full","style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"0","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;padding-top:0;padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"className":"nsf-resource-overview","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns nsf-resource-overview"><!-- wp:column {"width":"320px","style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
<div class="wp-block-column" style="flex-basis:320px"><!-- wp:post-featured-image {"aspectRatio":"17/22","width":"320px","sizeSlug":"large"} /-->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"metadata":{"bindings":{"url":{"source":"nsf/resource","args":{"key":"file-url"}}}}} -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Download the report', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"nsf/resource","args":{"key":"file-details"}}}},"fontSize":"x-small"} -->
<p class="has-x-small-font-size"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph -->
<p><?php echo esc_html__( 'Summary: what this resource is, who it is for and where its data comes from.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html__( 'A second paragraph on what it found or what readers will learn.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html__( 'A closing line that sums it up.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
