<?php
/**
 * Title: Press releases
 * Slug: nsf/press-releases
 * Categories: nsf-sections
 * Keywords: press, media, news, releases, load more
 * Description: Heading, a ruled list of press releases (date, title, Read more) and a Load more button, on a white to Lightest Blue gradient. Media Center mockup. The list is static until press releases have a post category.
 *
 * @package NSF
 */

$nsf_releases = array(
	__( 'National Sleep Foundation Assembles Leading Experts to Shape the Future of Drowsy Driving Prevention', 'nsf' ),
	__( 'National Sleep Foundation Will Convene National Roadway Safety Leaders To Advance Sleep Health and Transportation Safety', 'nsf' ),
	__( 'National Sleep Foundation Expands Drowsy Driving Programs to Enhance Sleep Health and Safety', 'nsf' ),
	__( 'National Sleep Foundation Announces 9th Annual SleepTech® Award', 'nsf' ),
	__( 'National Sleep Foundation Names Mark R. Rosekind, PhD, To Chair Board of Directors', 'nsf' ),
	__( 'National Sleep Foundation and Tempur-Pedic Compare Notes on What’s Keeping the Nation Awake', 'nsf' ),
);
?>
<!-- wp:group {"metadata":{"name":"Press releases"},"align":"full","className":"nsf-press-releases","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nsf-press-releases" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Press releases', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"nsf-press-list","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-press-list">
<?php foreach ( $nsf_releases as $nsf_release ) : ?>
<!-- wp:group {"className":"nsf-press-release","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-press-release"><!-- wp:paragraph {"className":"nsf-press-release__date"} -->
<p class="nsf-press-release__date"><?php echo esc_html__( 'Month DD, YYYY', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-press-release__title"} -->
<p class="nsf-press-release__title"><?php echo esc_html( $nsf_release ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link"} -->
<p class="is-style-link"><a href="#"><?php echo esc_html__( 'Read more', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-secondary"} -->
<div class="wp-block-button is-style-secondary"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Load more', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
