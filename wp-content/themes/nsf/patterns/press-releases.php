<?php
/**
 * Title: Press releases
 * Slug: nsf/press-releases
 * Categories: nsf-sections
 * Keywords: press, media, news, releases, load more
 * Description: Heading, then the newest six posts in the Press release category as a ruled list (date, title, Read more) with a Load more button, on Lightest Blue. Media Center mockup (Figma 574:102).
 *
 * @package NSF
 */

$nsf_term = get_term_by( 'slug', 'press-release', 'category' );
$nsf_cat  = $nsf_term ? (int) $nsf_term->term_id : 0;
?>
<!-- wp:group {"metadata":{"name":"Press releases"},"align":"full","className":"is-style-section-lightest-blue nsf-press-releases","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-press-releases" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Press releases', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:query {"queryId":71,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false,"taxQuery":{"category":[<?php echo (int) $nsf_cat; ?>]}},"className":"nsf-load-more"} -->
<div class="wp-block-query nsf-load-more"><!-- wp:post-template {"className":"nsf-press-list","layout":{"type":"default"}} -->
<!-- wp:group {"className":"nsf-press-release","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-press-release"><!-- wp:post-date {"format":"F j, Y","className":"nsf-press-release__date"} /-->

<!-- wp:post-title {"level":3,"className":"nsf-press-release__title"} /-->

<!-- wp:read-more {"content":"<?php echo esc_attr__( 'Read more', 'nsf' ); ?>"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"paginationArrow":"none","layout":{"type":"flex","justifyContent":"left"}} -->
<!-- wp:query-pagination-next {"label":"<?php echo esc_attr__( 'Load more', 'nsf' ); ?>"} /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->
