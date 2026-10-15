<?php
/**
 * Title: Survey results with icons
 * Slug: nsf/drowsy-driving-prevention-week-survey
 * Categories: nsf-sections
 * Keywords: survey, results, findings, drowsy driving, icons
 * Description: Centered intro (icon, status chip, heading, text, serif subhead), key results as rows with a large round icon, a heading and a dot list, and a closing serif statement. Change an icon with its row's nsf-ddpw-icon-- class (home, car, family, shield). Used on the Drowsy Driving Prevention Week® page.
 *
 * @package NSF
 */

$nsf_ddpw_results = array(
	array( 'home', __( 'Sleep is a Top Priority for Family Health and Safety', 'nsf' ), array( __( 'Parents rank getting enough sleep to drive alert as the most important thing to keep their families healthy and safe—higher than a healthy diet, physical activity, and limiting TV time.', 'nsf' ) ) ),
	array( 'car', __( 'Most People Drive Drowsy, Especially Parents and Teenagers', 'nsf' ), array( __( 'Parents are more likely to have driven drowsy compared to people who are not parents.', 'nsf' ), __( 'An estimated 1.7 million teens nationwide report having driven drowsy.', 'nsf' ) ) ),
	array( 'family', __( 'Families With the Youngest and Oldest Children Drive Drowsy Most Often', 'nsf' ), array( __( 'From frequent nighttime awakenings to early school drop-offs and multiple competing demands, families face many sleep challenges.', 'nsf' ) ) ),
	array( 'shield', __( 'Families Can Contribute to and Prevent Drowsy Driving', 'nsf' ), array( __( 'Over 1/3 of adults and more than 20% of teens said family obligations get in the way of getting the sleep they need to drive alert.', 'nsf' ), __( 'More than 7 in 10 adults have urged someone not to drive when too tired, with many people asking family members to make safe driving choices.', 'nsf' ) ) ),
);
?>
<!-- wp:group {"metadata":{"name":"Drowsy Driving Survey"},"align":"full","className":"is-style-section-white nsf-ddpw-section nsf-ddpw-survey","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-ddpw-section nsf-ddpw-survey" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Intro"},"className":"nsf-ddpw-stack nsf-ddpw-center nsf-ddpw-narrow nsf-ddpw-survey__intro","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-stack nsf-ddpw-center nsf-ddpw-narrow nsf-ddpw-survey__intro"><!-- wp:group {"className":"nsf-ddpw-icon nsf-ddpw-icon--document","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-icon nsf-ddpw-icon--document"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"nsf-ddpw-chip"} -->
<p class="nsf-ddpw-chip"><?php esc_html_e( '2026 Survey Results Coming Soon', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'The 2025 Drowsy Driving Survey', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-ddpw-text-lg"} -->
<p class="nsf-ddpw-text-lg"><?php esc_html_e( 'There is strong public awareness of drowsy driving risks among both adults and teens as well as missed opportunities for prevention. But drowsy driving goes beyond individual behavior. Families play a vital role in ensuring everyone gets enough quality sleep to drive alert and in holding each other accountable. NSF’s goal is to help families prioritize sleep and reduce the number of sleep-deprived drivers on the road. Together, we can prevent thousands of crashes each year.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-ddpw-serif nsf-ddpw-serif--italic"} -->
<p class="nsf-ddpw-serif nsf-ddpw-serif--italic"><?php esc_html_e( 'Drowsy Driving is a Family Sleep Health Issue', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Key survey results"},"className":"nsf-ddpw-results","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-results"><!-- wp:paragraph {"className":"is-style-eyebrow-small nsf-ddpw-results__label"} -->
<p class="is-style-eyebrow-small nsf-ddpw-results__label"><?php esc_html_e( 'Key survey results', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<?php foreach ( $nsf_ddpw_results as $nsf_result ) : ?>
<!-- wp:group {"className":"nsf-ddpw-result","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-result"><!-- wp:group {"className":"nsf-ddpw-icon nsf-ddpw-icon--xl nsf-ddpw-icon--<?php echo esc_attr( $nsf_result[0] ); ?>","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-icon nsf-ddpw-icon--xl nsf-ddpw-icon--<?php echo esc_attr( $nsf_result[0] ); ?>"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"nsf-ddpw-result__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-result__copy"><!-- wp:heading {"level":3,"className":"nsf-ddpw-h3"} -->
<h3 class="wp-block-heading nsf-ddpw-h3"><?php echo esc_html( $nsf_result[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-dot nsf-ddpw-dots"} -->
<ul class="wp-block-list is-style-dot nsf-ddpw-dots"><?php foreach ( $nsf_result[2] as $nsf_item ) : ?><!-- wp:list-item -->
<li><?php echo esc_html( $nsf_item ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"nsf-ddpw-serif nsf-ddpw-pull"} -->
<p class="nsf-ddpw-serif nsf-ddpw-pull"><?php esc_html_e( 'Keep your family and others safe on the road. The best way to avoid drowsy driving is to', 'nsf' ); ?> <span class="has-primary-orange-color"><?php esc_html_e( 'Sleep First. Drive Alert.', 'nsf' ); ?><sup>®</sup></span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
