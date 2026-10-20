<?php
/**
 * Title: Research
 * Slug: nsf/home-research
 * Categories: nsf-sections
 * Keywords: home, research, featured, panels
 * Description: Eyebrow, heading, a featured research row with an image, and three link panels. Home mockup section 05.
 *
 * @package NSF
 */

/**
 * One outlined link panel.
 *
 * @param string $title Panel heading.
 * @param array  $items List items.
 * @param string $link  Link text.
 * @param string $url   Link URL.
 */
$nsf_panel = function ( $title, $items, $link, $url ) {
	?>
<!-- wp:group {"className":"is-style-panel-outline","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-panel-outline"><!-- wp:heading {"level":3,"className":"is-style-card-heading nsf-trim"} -->
<h3 class="wp-block-heading is-style-card-heading nsf-trim"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-dot"} -->
<ul class="wp-block-list is-style-dot"><?php foreach ( $items as $nsf_item ) : ?><!-- wp:list-item -->
<li><?php echo esc_html( $nsf_item ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list -->

<!-- wp:paragraph {"className":"is-style-link nsf-trim"} -->
<p class="is-style-link nsf-trim"><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $link ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
	<?php
};
?>
<!-- wp:group {"metadata":{"name":"Research"},"align":"full","className":"is-style-section-white","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'Research', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Groundbreaking research on the state of our sleep', 'nsf' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:columns {"metadata":{"name":"Featured research"},"className":"nsf-feature-row","style":{"spacing":{"blockGap":{"top":"0","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns nsf-feature-row"><!-- wp:column {"className":"nsf-feature-row__copy","style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
<div class="wp-block-column nsf-feature-row__copy"><!-- wp:paragraph {"className":"is-style-eyebrow-small nsf-trim"} -->
<p class="is-style-eyebrow-small nsf-trim"><?php esc_html_e( 'Featured research', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Sleep in America® Poll: A Look at Children’s Sleep Health', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'Nearly half of U.S. children (44%) do not consistently get the recommended amount of sleep for their age, and four in five parents say their own sleep suffers when their child sleeps poorly.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link nsf-trim"} -->
<p class="is-style-link nsf-trim"><a href="/research/nsf-research-reports/sleep-in-america-polls/"><?php esc_html_e( 'Read the findings', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"480px","className":"nsf-feature-row__media"} -->
<div class="wp-block-column nsf-feature-row__media" style="flex-basis:480px"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/home/research.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"metadata":{"name":"Panels"},"style":{"spacing":{"blockGap":"var:preset|spacing|gutter"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"16rem"}} -->
<div class="wp-block-group"><?php
$nsf_panel( __( 'NSF Research Tools', 'nsf' ), array( __( 'Sleep Health Index®', 'nsf' ), __( 'Sleep Satisfaction Tool®', 'nsf' ), __( 'Best Slept Self® Questionnaire', 'nsf' ) ), __( 'Explore the tools', 'nsf' ), '/research/nsf-sleep-measures/' );
$nsf_panel( __( 'NSF Publications', 'nsf' ), array( __( 'Sleep in America® Polls', 'nsf' ), __( 'Guidelines', 'nsf' ), __( 'Survey results & infographics', 'nsf' ) ), __( 'Browse publications', 'nsf' ), '/research/nsf-publications/' );
$nsf_panel( __( 'Sleep Health: Journal of the NSF', 'nsf' ), array( __( 'Current issue', 'nsf' ), __( 'For authors', 'nsf' ), __( 'Editorial board', 'nsf' ) ), __( 'Visit the journal', 'nsf' ), 'https://www.sleephealthjournal.org/' );
?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
