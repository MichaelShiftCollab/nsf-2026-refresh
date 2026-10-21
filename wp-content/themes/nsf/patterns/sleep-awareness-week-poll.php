<?php
/**
 * Title: Sleep in America® Poll: feature and findings
 * Slug: nsf/sleep-awareness-week-poll
 * Categories: nsf-sections
 * Keywords: sleep in america, poll, findings, sleep awareness week
 * Description: Two Primary Blue bands (mockup 505:266 and 505:273): the year's poll beside its logo, then the campaign logo, a heading, four findings with an icon each, and a closing note. Used on the Sleep Awareness Week® page.
 *
 * @package NSF
 */

$nsf_saw_findings = array(
	array( 'icon-childrens-sleep-1.png', __( 'Children Aren’t Sleeping Enough', 'nsf' ), __( 'Nearly half of U.S. children (44%) do not consistently get the recommended amount of sleep for their age. Younger children are especially likely to fall short.', 'nsf' ) ),
	array( 'icon-childrens-sleep-2.png', __( 'Parents Underestimate Children’s Sleep Needs', 'nsf' ), __( 'The amount of sleep parents estimate their child needs falls short of NSF recommendations, often by more than an hour per day.', 'nsf' ) ),
	array( 'icon-childrens-sleep-3.png', __( 'Children’s Sleep Affects the Whole Family', 'nsf' ), __( 'Nearly everyone (95%) agrees that good sleep is essential to family functioning, and four in five parents say their own sleep suffers when their child sleeps poorly.', 'nsf' ) ),
	array( 'icon-childrens-sleep-4.png', __( 'It’s Time to Prioritize Sleep', 'nsf' ), __( 'Nearly half of parents rarely or never talk with their children about the importance of sleep.', 'nsf' ) ),
);

$nsf_saw_poll_image = fn( $file ) => esc_url( get_theme_file_uri( 'assets/images/sleep-awareness-week/' . $file ) );
?>
<!-- wp:group {"metadata":{"name":"Sleep in America Poll"},"align":"full","className":"is-style-section-primary-blue nsf-saw-section nsf-saw-poll","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-primary-blue nsf-saw-section nsf-saw-poll" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-saw-feature","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-feature"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-saw-logo nsf-saw-logo--poll"} -->
<figure class="wp-block-image size-full nsf-saw-logo nsf-saw-logo--poll"><img src="<?php echo $nsf_saw_poll_image( 'sleep-in-america-poll-logo-white.png' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" alt="<?php esc_attr_e( 'Sleep in America® Poll, powered by the National Sleep Foundation', 'nsf' ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"nsf-saw-stack nsf-saw-stack--18","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack nsf-saw-stack--18"><!-- wp:paragraph {"className":"is-style-eyebrow","textColor":"medium-orange"} -->
<p class="is-style-eyebrow has-medium-orange-color has-text-color"><?php esc_html_e( 'Sleep in America® Poll', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'A Look at Children’s Sleep Health', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'Each year we survey Americans to find out the state of the nation’s sleep health. The 2026 Poll focused on the sleep health of American youth, specifically children ages 0 to 13.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Poll findings"},"align":"full","className":"is-style-section-primary-blue nsf-saw-section nsf-saw-findings-band","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-primary-blue nsf-saw-section nsf-saw-findings-band" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-saw-stack nsf-saw-findings-head","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack nsf-saw-findings-head"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-saw-logo nsf-saw-logo--vertical"} -->
<figure class="wp-block-image size-full nsf-saw-logo nsf-saw-logo--vertical"><img src="<?php echo $nsf_saw_poll_image( 'saw-2026-logo-vertical-white.png' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" alt="<?php esc_attr_e( 'Sleep Awareness Week® 2026, powered by the National Sleep Foundation', 'nsf' ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'A Focus on America’s Youngest Sleepers', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'Understanding children’s sleep in the context of family sleep health', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Findings"},"className":"nsf-saw-findings","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-findings"><?php foreach ( $nsf_saw_findings as $nsf_finding ) : ?><!-- wp:group {"className":"nsf-saw-finding","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-finding"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-saw-finding__icon"} -->
<figure class="wp-block-image size-full nsf-saw-finding__icon"><img src="<?php echo $nsf_saw_poll_image( $nsf_finding[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:heading {"level":3,"className":"is-style-card-heading nsf-trim"} -->
<h3 class="wp-block-heading is-style-card-heading nsf-trim"><?php echo esc_html( $nsf_finding[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php echo esc_html( $nsf_finding[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Closing note"},"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:paragraph {"className":"nsf-saw-note nsf-trim"} -->
<p class="nsf-saw-note nsf-trim"><?php esc_html_e( 'Parents, talk to your kids about the importance of sleep. Use healthy sleep behaviors to be a Best Slept® Family.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-saw-crisis nsf-trim"} -->
<p class="nsf-saw-crisis nsf-trim"><?php esc_html_e( 'For anyone experiencing suicidal thoughts, contact the Suicide and Crisis Lifeline by calling or texting 988.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
