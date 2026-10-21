<?php
/**
 * Title: Page: Drowsy Driving Prevention Resources
 * Slug: nsf/page-drowsy-driving-prevention-resources
 * Categories: nsf-pages
 * Post Types: page
 * Keywords: drowsy driving, resource center, forum, infographics, reports, page
 * Description: Drowsy Driving Prevention Resource Center page body for the "No Title" template: title band with a photo, about the program, activity cards, the forum video with speakers, and blog, infographic and report cards. Placeholder copy from the mockup.
 *
 * @package NSF
 */

/**
 * One activity card: image, eyebrow, title, text and a link.
 *
 * @param string $image   Theme image path.
 * @param string $eyebrow Date or place.
 * @param string $title   Card title (may hold <sup>).
 * @param string $text    Short description.
 * @param string $link    Link text.
 * @param string $url     Link URL.
 * @param bool   $graphic The image is a graphic shown whole on Primary Blue.
 */
$nsf_rc_activity = function ( $image, $eyebrow, $title, $text, $link, $url, $graphic ) {
	$nsf_image_class = 'nsf-rc-card__image' . ( $graphic ? ' is-graphic' : '' );
	?>
<!-- wp:group {"metadata":{"name":"Activity card"},"className":"nsf-rc-card nsf-rc-card--activity","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-rc-card nsf-rc-card--activity"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"<?php echo esc_attr( $nsf_image_class ); ?>"} -->
<figure class="wp-block-image size-full <?php echo esc_attr( $nsf_image_class ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( $image ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"nsf-rc-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-rc-card__body"><!-- wp:group {"className":"nsf-rc-card__top","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-rc-card__top"><!-- wp:paragraph {"className":"is-style-eyebrow-small nsf-trim"} -->
<p class="is-style-eyebrow-small nsf-trim"><?php echo esc_html( $eyebrow ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"nsf-rc-card__title nsf-trim"} -->
<h3 class="wp-block-heading nsf-rc-card__title nsf-trim"><?php echo wp_kses( $title, array( 'sup' => array() ) ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php echo esc_html( $text ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"is-style-link nsf-rc-card__link nsf-trim"} -->
<p class="is-style-link nsf-rc-card__link nsf-trim"><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $link ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
	<?php
};

/**
 * One forum speaker: name and role.
 */
$nsf_rc_speaker = function () {
	?>
<!-- wp:group {"className":"nsf-rc-speaker","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-rc-speaker"><!-- wp:paragraph {"className":"nsf-rc-speaker__name nsf-trim"} -->
<p class="nsf-rc-speaker__name nsf-trim"><?php esc_html_e( 'Speaker name', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'Role, Organization', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

	<?php
};

/**
 * A small Primary Blue label over a group of cards.
 *
 * @param string $label Label text.
 */
$nsf_rc_subhead = function ( $label ) {
	?>
<!-- wp:paragraph {"className":"is-style-eyebrow-small nsf-rc-subhead"} -->
<p class="is-style-eyebrow-small nsf-rc-subhead"><?php echo esc_html( $label ); ?></p>
<!-- /wp:paragraph -->

	<?php
};

$nsf_tbp = array(
	'eyebrow'  => __( 'National Programs', 'nsf' ),
	'heading'  => __( 'Drowsy Driving Prevention Resource Center', 'nsf' ),
	'subtitle' => __( 'Drowsy driving is impaired driving, and is responsible for more than one in every five crash-related fatalities. These aren’t just statistics: they represent real people, families, and communities. Drowsy driving is largely preventable.', 'nsf' ),
	'image'    => 'assets/images/home/hero-1.jpg',
	'mark'     => 'wheel',
);
require __DIR__ . '/title-band-photo.php';
?>

<!-- wp:group {"metadata":{"name":"About the program"},"align":"full","className":"is-style-section-lightest-blue nsf-rc-about","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-rc-about" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"className":"nsf-rc-about__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-rc-about__copy"><!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'National Sleep Foundation is the public’s leading authority on sleep and its impact on health, well-being, performance, and safety. For over 35 years, NSF has advanced education, research, public awareness, and stakeholder engagement to reduce drowsy driving and improve roadway safety. Drowsy driving prevention is a core focus area within NSF’s broader sleep health and safety efforts.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'Throughout the year, NSF works with transportation leaders, employers, policymakers, researchers, and industry partners to advance evidence-based approaches to drowsy driving prevention. Activities include public education, research and data initiatives, policy engagement, and development of practical tools and resources for drivers and communities.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'Drowsy Driving Prevention Week® and NSF’s annual Drowsy Driving Forum serve as anchor activities within these year-round efforts. NSF brings together leaders from transportation, public health, policymaking, and industry to address drowsy driving as a critical and solvable public safety issue.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Activities"},"align":"full","className":"is-style-section-white nsf-rc-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-rc-section" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Activities', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"nsf-rc-grid nsf-rc-grid--2","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-rc-grid nsf-rc-grid--2"><?php
$nsf_rc_activity( 'assets/images/home/campaign-large.jpg', __( 'November 1–7, 2026', 'nsf' ), 'Drowsy Driving Prevention Week<sup>®</sup>', __( 'Sleep First. Drive Alert.® NSF’s annual campaign encourages everyone to prioritize sleep and drive alert and refreshed.', 'nsf' ), __( 'Visit the campaign', 'nsf' ), '/national-programs/drowsy-driving-prevention/', false );
$nsf_rc_activity( 'assets/images/drowsy-driving-prevention-week/forum-graphic.png', __( 'October 29, Washington, DC', 'nsf' ), __( 'NSF Drowsy Driving Forum', 'nsf' ), __( 'Leaders from transportation, public health, policymaking and industry meet to address drowsy driving as a solvable public safety issue.', 'nsf' ), __( 'Learn more and register', 'nsf' ), '#', true );
?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Forum video"},"align":"full","className":"is-style-section-primary-blue nsf-rc-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-primary-blue nsf-rc-section" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( '2025 Forum', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"nsf-rc-forum","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-rc-forum"><!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( 'assets/images/home/research.jpg' ) ); ?>","dimRatio":50,"overlayColor":"dark-blue","isUserOverlayColor":true,"contentPosition":"center center","className":"nsf-rc-video","layout":{"type":"default"}} -->
<div class="wp-block-cover nsf-rc-video"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/home/research.jpg' ) ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-dark-blue-background-color has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"className":"nsf-rc-video__play"} -->
<p class="nsf-rc-video__play"><a href="#"><?php esc_html_e( 'Play the 2025 Forum video', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"metadata":{"name":"Speakers"},"className":"nsf-rc-speakers","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-rc-speakers"><!-- wp:paragraph {"className":"nsf-rc-speakers__label"} -->
<p class="nsf-rc-speakers__label"><?php esc_html_e( 'Speakers', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<?php
for ( $nsf_i = 0; $nsf_i < 5; $nsf_i++ ) {
	$nsf_rc_speaker();
}
?></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Prevention resources"},"align":"full","className":"is-style-section-white nsf-rc-section nsf-rc-resources","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-rc-section nsf-rc-resources" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Drowsy Driving Prevention Resources', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"metadata":{"name":"Key blog posts"},"className":"nsf-rc-group","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-rc-group"><?php $nsf_rc_subhead( __( 'Key blog posts', 'nsf' ) ); ?><?php
$nsf_cards = array( 'count' => 3, 'columns' => 3, 'category' => 'drowsy-driving', 'excerpt' => false, 'date' => true, 'compact' => true, 'link' => '' );
require __DIR__ . '/../inc/post-cards.php';
?></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Infographics"},"className":"nsf-rc-group","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-rc-group"><?php
$nsf_rc_subhead( __( 'Infographics', 'nsf' ) );
$nsf_dl = array(
	'contain' => true,
	'items'   => array(
		array( '2025', __( 'Sleep First. Drive Alert.® Infographic', 'nsf' ), '#', 'assets/images/drowsy-driving-prevention-week/illustration-risky.png' ),
		array( '2024', __( 'Drowsy Driving Prevention Week® Infographic', 'nsf' ), '#', 'assets/images/drowsy-driving-prevention-week/illustration-risk.png' ),
		array( '2023', __( 'Drowsy Driving by the Numbers', 'nsf' ), '#', 'assets/images/drowsy-driving-prevention-week/illustration-prevalence.png' ),
	),
);
require __DIR__ . '/download-cards.php';
?></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Reports"},"className":"nsf-rc-group","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-rc-group"><?php
$nsf_rc_subhead( __( 'Reports', 'nsf' ) );
$nsf_dl = array(
	'items' => array(
		array( '2026', __( 'Sleep in America® Poll: Drowsy Driving and Family Sleep Health', 'nsf' ), '#', 'assets/images/home/campaign-small-left.jpg' ),
		array( '2025', __( 'Drowsy Driving Prevention Week® Findings', 'nsf' ), '#', 'assets/images/home/card-1.jpg' ),
		array( '2024', __( 'Drowsy Driving Position Statement', 'nsf' ), '#', 'assets/images/home/research.jpg' ),
	),
);
require __DIR__ . '/download-cards.php';
?></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/sleep-health-resources/"><?php esc_html_e( 'More Drowsy Driving Prevention resources', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
