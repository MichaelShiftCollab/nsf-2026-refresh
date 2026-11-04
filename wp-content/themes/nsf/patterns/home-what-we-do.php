<?php
/**
 * Title: What we do
 * Slug: nsf/home-what-we-do
 * Categories: nsf-sections
 * Keywords: home, intro, pillars, about
 * Description: Eyebrow, heading, intro paragraph, three pillars with icons and a button. Home mockup section 02 (641:979).
 *
 * @package NSF
 */

/**
 * One pillar: an outline icon, an H3 and a paragraph (641:986).
 *
 * @param string $icon  Icon file in assets/images/icons, without .svg.
 * @param string $title Pillar heading.
 * @param string $text  Paragraph.
 */
$nsf_pillar = function ( $icon, $title, $text ) {
	?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-icon"} -->
<figure class="wp-block-image size-full nsf-icon"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/icons/' . $icon . '.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php echo esc_html( $text ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
	<?php
};
?>
<!-- wp:group {"metadata":{"name":"What we do"},"align":"full","className":"is-style-section-white nsf-home-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-home-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Intro"},"className":"nsf-home-intro","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained","contentSize":"840px","justifyContent":"left"}} -->
<div class="wp-block-group nsf-home-intro"><!-- wp:group {"metadata":{"name":"Heading group"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'What we do', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'The leading voice in sleep health', 'nsf' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'National Sleep Foundation is an independent nonprofit, dedicated to improving health and well-being by advancing sleep health. Our promise to the public is to help anyone and everyone be their Best Slept Self®. We seek out the latest scientific insights about sleep and turn our findings into simple-to-understand resources that help people get the healthy, restorative sleep they need. And we’ve been doing it for over 35 years.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Pillars"},"className":"nsf-pillars","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"16rem"}} -->
<div class="wp-block-group nsf-pillars"><?php
$nsf_pillar( 'search', __( 'Research', 'nsf' ), __( 'We conduct groundbreaking research and use proven methods to investigate how cultural behavior and the latest trends are impacting the state of our sleep.', 'nsf' ) );
$nsf_pillar( 'clipboard-list', __( 'Guidelines', 'nsf' ), __( 'We work with panels of experts to create evidence-based guidelines and easy-to-follow, actionable tips that lead to healthier sleep.', 'nsf' ) );
$nsf_pillar( 'globe-americas', __( 'National Programs', 'nsf' ), __( 'We spread the word through Sleep Awareness Week®, Drowsy Driving Prevention Week® and Best Slept Self® — making sleep science simple to understand.', 'nsf' ) );
?></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/mission-and-goals/"><?php esc_html_e( 'Find out more about NSF  →', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
