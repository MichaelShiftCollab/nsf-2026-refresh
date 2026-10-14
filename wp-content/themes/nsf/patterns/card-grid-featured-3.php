<?php
/**
 * Title: Card grid: featured image, 3-up
 * Slug: nsf/card-grid-featured-3
 * Categories: nsf-cards
 * Keywords: cards, grid
 * Description: Query Loop of the latest 3 posts as featured image cards. Change the query to show resources or a topic.
 *
 * @package NSF
 */

?>
<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"metadata":{"name":"Card grid (3-up)"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|gutter"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"16rem"}} -->
<!-- wp:nsf/content-card {"variant":"featured-image"} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query -->
