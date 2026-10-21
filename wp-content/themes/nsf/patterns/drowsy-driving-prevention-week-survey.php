<?php
/**
 * Title: Survey results with icons
 * Slug: nsf/drowsy-driving-prevention-week-survey
 * Categories: nsf-sections
 * Keywords: survey, results, findings, drowsy driving, icons
 * Description: Primary Blue band: centered intro (dashed wheel graphic, status eyebrow, heading, text, italic subhead), key results as rows with an icon, a heading and a dot list, and a closing italic statement. Used on the Drowsy Driving Prevention Week® page.
 *
 * @package NSF
 */

$nsf_ddpw_results = array(
	array( 'survey-icon-priority.png', __( 'Sleep is a Top Priority for Family Health and Safety', 'nsf' ), array( __( 'Parents rank getting enough sleep to drive alert as the most important thing to keep their families healthy and safe—higher than a healthy diet, physical activity, and limiting TV time.', 'nsf' ) ) ),
	array( 'survey-icon-parents-teens.png', __( 'Most People Drive Drowsy, Especially Parents and Teenagers', 'nsf' ), array( __( 'Parents are more likely to have driven drowsy compared to people who are not parents.', 'nsf' ), __( 'An estimated 1.7 million teens nationwide report having driven drowsy.', 'nsf' ) ) ),
	array( 'survey-icon-families.png', __( 'Families With the Youngest and Oldest Children Drive Drowsy Most Often', 'nsf' ), array( __( 'From frequent nighttime awakenings to early school drop-offs and multiple competing demands, families face many sleep challenges.', 'nsf' ) ) ),
	array( 'survey-icon-prevent.png', __( 'Families Can Contribute to and Prevent Drowsy Driving', 'nsf' ), array( __( 'Over 1/3 of adults and more than 20% of teens said family obligations get in the way of getting the sleep they need to drive alert.', 'nsf' ), __( 'More than 7 in 10 adults have urged someone not to drive when too tired, with many people asking family members to make safe driving choices.', 'nsf' ) ) ),
);
$nsf_ddpw_dir = 'assets/images/drowsy-driving-prevention-week/';
?>
<!-- wp:group {"metadata":{"name":"Drowsy Driving Survey"},"align":"full","className":"is-style-section-primary-blue nsf-ddpw-section nsf-ddpw-survey","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-primary-blue nsf-ddpw-section nsf-ddpw-survey" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-ddpw-stack nsf-ddpw-center nsf-ddpw-narrow nsf-ddpw-survey__intro","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-stack nsf-ddpw-center nsf-ddpw-narrow nsf-ddpw-survey__intro"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-ddpw-art nsf-ddpw-art--wheel"} -->
<figure class="wp-block-image size-full nsf-ddpw-art nsf-ddpw-art--wheel"><img src="<?php echo esc_url( get_theme_file_uri( $nsf_ddpw_dir . 'ddpw-wheel-dashed.png' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"is-style-eyebrow","textColor":"medium-orange"} -->
<p class="is-style-eyebrow has-medium-orange-color has-text-color"><?php esc_html_e( '2026 Survey Results Coming Soon', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'The 2025 Drowsy Driving Survey', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'There is strong public awareness of drowsy driving risks among both adults and teens as well as missed opportunities for prevention. But drowsy driving goes beyond individual behavior. Families play a vital role in ensuring everyone gets enough quality sleep to drive alert and in holding each other accountable. NSF’s goal is to help families prioritize sleep and reduce the number of sleep-deprived drivers on the road. Together, we can prevent thousands of crashes each year.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-ddpw-statement nsf-trim"} -->
<p class="nsf-ddpw-statement nsf-trim"><?php esc_html_e( 'Drowsy Driving is a Family Sleep Health Issue', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Key survey results"},"className":"nsf-ddpw-results","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-results"><!-- wp:paragraph {"align":"center","className":"is-style-eyebrow-small","textColor":"white"} -->
<p class="has-text-align-center is-style-eyebrow-small has-white-color has-text-color"><?php esc_html_e( 'Key survey results', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<?php foreach ( $nsf_ddpw_results as $nsf_result ) : ?>
<!-- wp:group {"className":"nsf-ddpw-result","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-result"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-ddpw-art nsf-ddpw-art--result"} -->
<figure class="wp-block-image size-full nsf-ddpw-art nsf-ddpw-art--result"><img src="<?php echo esc_url( get_theme_file_uri( $nsf_ddpw_dir . $nsf_result[0] ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"nsf-ddpw-result__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-result__copy"><!-- wp:heading {"level":3,"className":"is-style-card-heading nsf-trim"} -->
<h3 class="wp-block-heading is-style-card-heading nsf-trim"><?php echo esc_html( $nsf_result[1] ); ?></h3>
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

<!-- wp:paragraph {"align":"center","className":"nsf-ddpw-statement nsf-ddpw-narrow nsf-trim"} -->
<p class="has-text-align-center nsf-ddpw-statement nsf-ddpw-narrow nsf-trim"><?php esc_html_e( 'Keep your family and others safe on the road. The best way to avoid drowsy driving is to Sleep First. Drive Alert.®', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
