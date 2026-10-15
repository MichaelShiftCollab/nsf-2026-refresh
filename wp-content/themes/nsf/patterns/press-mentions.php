<?php
/**
 * Title: Press mentions
 * Slug: nsf/press-mentions
 * Categories: nsf-sections
 * Keywords: press, media, news, coverage, mentions
 * Description: Heading and a ruled list of stories that mention NSF: outlet and date, headline, and a link to the story. Media Center mockup.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Press mentions"},"align":"full","className":"is-style-section-white nsf-press-mentions","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-press-mentions" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Press mentions', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"nsf-press-list","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-press-list">
<?php for ( $nsf_i = 0; $nsf_i < 4; $nsf_i++ ) : ?>
<!-- wp:group {"className":"nsf-press-mention","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-press-mention"><!-- wp:paragraph {"className":"is-style-eyebrow-small nsf-press-mention__meta"} -->
<p class="is-style-eyebrow-small nsf-press-mention__meta"><?php echo esc_html__( 'Outlet name', 'nsf' ); ?>&nbsp;&nbsp;·&nbsp;&nbsp;<?php echo esc_html__( 'Month DD, YYYY', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"is-style-card-heading"} -->
<h3 class="wp-block-heading is-style-card-heading"><?php echo esc_html__( 'Headline of the story that mentions NSF', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-link"} -->
<p class="is-style-link"><a href="#"><?php echo esc_html__( 'Read the story', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<?php endfor; ?>
</div>
<!-- /wp:group --></div>
<!-- /wp:group -->
