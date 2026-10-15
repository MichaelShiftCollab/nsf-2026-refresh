<?php
/**
 * Title: Sleep in America® Poll: feature and findings
 * Slug: nsf/sleep-awareness-week-poll
 * Categories: nsf-sections
 * Keywords: sleep in america, poll, findings, sleep awareness week
 * Description: The year's poll beside its logo, then a heading, four finding cards with an icon, and a callout with a note. Used on the Sleep Awareness Week® page.
 *
 * @package NSF
 */

$nsf_saw_findings = array(
	array( __( 'Children Aren’t Sleeping Enough', 'nsf' ), __( 'Nearly half of U.S. children (44%) do not consistently get the recommended amount of sleep for their age. Younger children are especially likely to fall short.', 'nsf' ) ),
	array( __( 'Parents Underestimate Children’s Sleep Needs', 'nsf' ), __( 'The amount of sleep parents estimate their child needs falls short of NSF recommendations, often by more than an hour per day.', 'nsf' ) ),
	array( __( 'Children’s Sleep Affects the Whole Family', 'nsf' ), __( 'Nearly everyone (95%) agrees that good sleep is essential to family functioning, and four in five parents say their own sleep suffers when their child sleeps poorly.', 'nsf' ) ),
	array( __( 'It’s Time to Prioritize Sleep', 'nsf' ), __( 'Nearly half of parents rarely or never talk with their children about the importance of sleep.', 'nsf' ) ),
);
?>
<!-- wp:group {"metadata":{"name":"Sleep in America Poll"},"align":"full","className":"is-style-section-white nsf-saw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-saw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-saw-feature","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-feature"><!-- wp:group {"metadata":{"name":"Poll logo"},"className":"nsf-saw-feature__logo","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-feature__logo"><!-- wp:paragraph -->
<p><?php esc_html_e( '2026 Poll logo', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"nsf-saw-feature__copy nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-feature__copy nsf-saw-stack"><!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php esc_html_e( 'Sleep in America® Poll', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'A Look at Children’s Sleep Health', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-saw-text-md"} -->
<p class="nsf-saw-text-md"><?php esc_html_e( 'Each year we survey Americans to find out the state of the nation’s sleep health. The 2026 Poll focused on the sleep health of American youth, specifically children ages 0 to 13.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Poll findings"},"align":"full","className":"is-style-section-lightest-blue nsf-saw-section nsf-saw-band","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-saw-section nsf-saw-band" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'A Focus on America’s Youngest Sleepers', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2","textColor":"primary-blue"} -->
<p class="is-style-paragraph-2 has-primary-blue-color has-text-color"><?php esc_html_e( 'Understanding children’s sleep in the context of family sleep health', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Findings"},"className":"nsf-saw-findings","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-findings"><?php foreach ( $nsf_saw_findings as $nsf_finding ) : ?><!-- wp:group {"className":"nsf-saw-finding","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-finding"><!-- wp:heading {"level":3,"className":"nsf-saw-finding__title"} -->
<h3 class="wp-block-heading nsf-saw-finding__title"><?php echo esc_html( $nsf_finding[0] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $nsf_finding[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Callout"},"className":"nsf-saw-callout nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-callout nsf-saw-stack"><!-- wp:paragraph {"className":"nsf-saw-callout__text"} -->
<p class="nsf-saw-callout__text"><?php esc_html_e( 'Parents, talk to your kids about the importance of sleep. Use healthy sleep behaviors to be a Best Slept® Family.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"x-small"} -->
<p class="has-x-small-font-size"><?php esc_html_e( 'For anyone experiencing suicidal thoughts, contact the Suicide and Crisis Lifeline by calling or texting 988.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
