<?php
/**
 * Title: Experts available for interview
 * Slug: nsf/media-experts
 * Categories: nsf-sections
 * Keywords: experts, media, press, interview, people, team
 * Description: Heading, intro and four Expert cards (initials circle, name, title and organization, topic chips) on Lightest Blue. Media Center mockup.
 *
 * @package NSF
 */

$nsf_expert_card = static function () {
	?>
<!-- wp:group {"className":"nsf-expert-card","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-expert-card"><!-- wp:paragraph {"className":"nsf-expert-card__avatar"} -->
<p class="nsf-expert-card__avatar"><?php echo esc_html_x( 'EN', 'expert initials', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"is-style-card-heading nsf-expert-card__name"} -->
<h3 class="wp-block-heading is-style-card-heading nsf-expert-card__name"><?php echo esc_html__( 'Expert name', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html__( 'Title, Organization', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"nsf-expert-card__topics","layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group nsf-expert-card__topics"><?php for ( $nsf_i = 0; $nsf_i < 3; $nsf_i++ ) : ?><!-- wp:paragraph {"className":"nsf-expert-card__topic"} -->
<p class="nsf-expert-card__topic"><?php echo esc_html__( 'topic', 'nsf' ); ?></p>
<!-- /wp:paragraph --><?php endfor; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
	<?php
};
?>
<!-- wp:group {"metadata":{"name":"Experts"},"align":"full","className":"is-style-section-lightest-blue nsf-band nsf-media-experts","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-band nsf-media-experts" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained","contentSize":"820px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Experts available for interview', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2"} -->
<p class="is-style-paragraph-2"><?php echo esc_html__( 'Intro — one sentence on the experts and how to request an interview through the media contact.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"nsf-media-grid","style":{"spacing":{"blockGap":"var:preset|spacing|gutter"}},"layout":{"type":"grid","columnCount":4}} -->
<div class="wp-block-group nsf-media-grid">
<?php
for ( $nsf_n = 0; $nsf_n < 4; $nsf_n++ ) {
	$nsf_expert_card();
}
?>
</div>
<!-- /wp:group --></div>
<!-- /wp:group -->
