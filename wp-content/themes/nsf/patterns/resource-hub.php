<?php
/**
 * Title: Resource Hub
 * Slug: nsf/resource-hub
 * Categories: nsf-pages
 * Keywords: resources, filter, search, hub
 * Description: Intro, three Featured Resources, then the filter rail and results (cards or table). For the Sleep Health Resources page.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Intro"},"className":"nsf-hub-intro","layout":{"type":"constrained","contentSize":"840px","justifyContent":"left"}} -->
<div class="wp-block-group nsf-hub-intro"><!-- wp:paragraph {"className":"is-style-paragraph-1"} -->
<p class="is-style-paragraph-1"><?php echo esc_html__( 'Intro paragraph: one or two sentences on what this section contains.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Featured"},"align":"full","anchor":"resource-featured","className":"is-style-section-lightest-blue nsf-hub-featured","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<div id="resource-featured" class="wp-block-group alignfull is-style-section-lightest-blue nsf-hub-featured"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Featured', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:nsf/featured-resources /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Filters and results"},"align":"full","anchor":"resource-browser","className":"nsf-hub-browser","layout":{"type":"constrained"}} -->
<div id="resource-browser" class="wp-block-group alignfull nsf-hub-browser"><!-- wp:columns {"className":"nsf-hub-columns","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|gutter"}}}} -->
<div class="wp-block-columns nsf-hub-columns"><!-- wp:column {"width":"295px"} -->
<div class="wp-block-column" style="flex-basis:295px"><!-- wp:nsf/resource-filters /--></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:nsf/resource-results /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
