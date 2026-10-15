<?php
/**
 * Title: Page: Drowsy Driving Prevention Week®
 * Slug: nsf/page-drowsy-driving-prevention-week
 * Categories: nsf-pages
 * Post Types: page
 * Keywords: drowsy driving, campaign, page
 * Description: Drowsy Driving Prevention Week® page body for the "No Title" template: campaign hero, the Drowsy Driving Forum, why drowsy driving matters, better sleep, the survey and its results, downloads, resources, sponsors and collaborators, and sponsorship. Placeholder copy from the mockup.
 *
 * @package NSF
 */

/**
 * An icon in a circle. Variants: warning, clock, people, moon, document,
 * download, home, car, family, shield.
 *
 * @param string $icon    Icon name.
 * @param string $classes Extra classes.
 */
$nsf_ddpw_icon = function ( $icon, $classes = '' ) {
	$nsf_class = trim( 'nsf-ddpw-icon nsf-ddpw-icon--' . $icon . ' ' . $classes );
	?>
<!-- wp:group {"className":"<?php echo esc_attr( $nsf_class ); ?>","layout":{"type":"default"}} -->
<div class="wp-block-group <?php echo esc_attr( $nsf_class ); ?>"></div>
<!-- /wp:group -->
	<?php
};

/**
 * One reason column: orange icon, heading and text.
 *
 * @param string $icon  Icon name.
 * @param string $title Heading.
 * @param string $text  Text.
 */
$nsf_ddpw_reason = function ( $icon, $title, $text ) use ( $nsf_ddpw_icon ) {
	?>
<!-- wp:group {"className":"nsf-ddpw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-stack"><?php $nsf_ddpw_icon( $icon, 'nsf-ddpw-icon--orange' ); ?>

<!-- wp:heading {"level":3,"className":"nsf-ddpw-h3"} -->
<h3 class="wp-block-heading nsf-ddpw-h3"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $text ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
	<?php
};

/**
 * One article card with an excerpt.
 *
 * @param string $image   Theme image path.
 * @param string $title   Title.
 * @param string $excerpt Excerpt.
 */
$nsf_ddpw_card = function ( $image, $title, $excerpt ) {
	?>
<!-- wp:group {"className":"nsf-ddpw-card","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-card"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-ddpw-card__image nsf-photo"} -->
<figure class="wp-block-image size-full nsf-ddpw-card__image nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( $image ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"nsf-ddpw-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-card__body"><!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php esc_html_e( 'Article', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"is-style-card-heading"} -->
<h3 class="wp-block-heading is-style-card-heading"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $excerpt ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link nsf-ddpw-card__more"} -->
<p class="is-style-link nsf-ddpw-card__more"><a href="/sleep-health-resources/sleep-learning-zone/"><?php esc_html_e( 'Learn more', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
	<?php
};

/**
 * Logo placeholders.
 *
 * @param int $count Number of logos.
 */
$nsf_ddpw_logos = function ( $count ) {
	for ( $nsf_i = 0; $nsf_i < $count; $nsf_i++ ) {
		?>
<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo-placeholder.svg' ) ); ?>" alt="<?php esc_attr_e( 'Company name', 'nsf' ); ?>"/></figure>
<!-- /wp:image -->
		<?php
	}
};
?>
<!-- wp:group {"metadata":{"name":"Campaign hero"},"align":"full","className":"nsf-ddpw-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nsf-ddpw-hero" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"className":"nsf-ddpw-hero__grid","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-hero__grid"><!-- wp:group {"className":"nsf-ddpw-hero__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-hero__copy"><!-- wp:group {"metadata":{"name":"Campaign logo"},"className":"nsf-ddpw-hero__logo","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-hero__logo"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Campaign logo', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"is-style-eyebrow-small nsf-ddpw-hero__eyebrow"} -->
<p class="is-style-eyebrow-small nsf-ddpw-hero__eyebrow"><?php esc_html_e( 'Drowsy Driving Prevention Week', 'nsf' ); ?><sup>®</sup><?php esc_html_e( '  ·  November 1–7, 2026', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"nsf-ddpw-hero__title"} -->
<h1 class="wp-block-heading nsf-ddpw-hero__title"><?php esc_html_e( 'Sleep First. Drive Alert.', 'nsf' ); ?><sup>®</sup></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-ddpw-text-lg"} -->
<p class="nsf-ddpw-text-lg"><?php esc_html_e( 'The National Sleep Foundation’s Drowsy Driving Prevention Week® encourages everyone to prioritize sleep and drive when they are alert and refreshed. Our goal is to help people get the sleep they need and reduce the number of drivers who choose to drive while sleep-deprived.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-ddpw-text-lg"} -->
<p class="nsf-ddpw-text-lg"><?php esc_html_e( 'Together, we can help people drive alert and work to prevent thousands of motor vehicle crashes each year.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-ddpw-text-lg nsf-ddpw-hero__note"} -->
<p class="nsf-ddpw-text-lg nsf-ddpw-hero__note"><?php esc_html_e( 'Save the date: NSF will hold a Drowsy Driving Forum in Washington, DC on October 29.', 'nsf' ); ?> <a href="#forum"><?php esc_html_e( 'View the program agenda and registration information here.', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-ddpw-hero__photo nsf-photo"} -->
<figure class="wp-block-image size-full nsf-ddpw-hero__photo nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/home/campaign-large.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php require __DIR__ . '/drowsy-driving-prevention-week-forum.php'; ?>

<!-- wp:group {"metadata":{"name":"Fall-asleep crashes"},"align":"full","className":"is-style-section-white nsf-ddpw-section nsf-ddpw-section--wide-gap","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-ddpw-section nsf-ddpw-section--wide-gap" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-ddpw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-stack"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'Drowsy Driving Prevention Week 2026', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"nsf-ddpw-heading-wide"} -->
<h2 class="wp-block-heading nsf-ddpw-heading-wide"><?php esc_html_e( 'Fall-asleep crashes are often caused by not getting the sleep you need', 'nsf' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Reasons"},"className":"nsf-ddpw-grid-3 nsf-ddpw-grid-3--wide","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-grid-3 nsf-ddpw-grid-3--wide"><?php
$nsf_ddpw_reason( 'warning', __( 'Drowsy driving is more likely to cause a crash.', 'nsf' ), __( 'Just like drunk, drugged, and distracted driving, drowsy driving is a real public health issue, causing thousands of car crashes each year and killing an estimated 6,400 people in the U.S. alone according to the AAA Foundation for Traffic Safety. 95% of Americans recognize that drowsy driving is dangerous yet nearly two-thirds of Americans report that they have driven while drowsy.', 'nsf' ) );
$nsf_ddpw_reason( 'clock', __( 'Drowsy driving is really risky.', 'nsf' ), __( 'When you drive without adequate sleep, your motor skills are seriously impaired. In fact, we’ll go as far as saying that drivers who’ve only slept 3 to 5 hours in the last 24 hours are unfit to drive. Most people understand it’s risky, but they don’t think about the consequences.', 'nsf' ) );
$nsf_ddpw_reason( 'people', __( 'Drowsy driving is dangerously common.', 'nsf' ), __( 'Young drivers (aged 16-25 years) and shift workers are at greatest risk of falling asleep behind the wheel, but most drivers can relate to a time when they have nodded off while driving. Importantly, drowsy driving is preventable.', 'nsf' ) );
?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Get the sleep you need"},"align":"full","className":"nsf-ddpw-section nsf-ddpw-multi","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nsf-ddpw-section nsf-ddpw-multi" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-ddpw-box nsf-ddpw-box--feature nsf-ddpw-center","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-box nsf-ddpw-box--feature nsf-ddpw-center"><?php $nsf_ddpw_icon( 'moon' ); ?>

<!-- wp:heading {"className":"nsf-ddpw-box__heading"} -->
<h2 class="wp-block-heading nsf-ddpw-box__heading"><?php esc_html_e( 'Get the sleep you need to be alert and refreshed when you drive', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-ddpw-text-lg"} -->
<p class="nsf-ddpw-text-lg"><?php esc_html_e( 'Being your Best Slept Self® is important so you can get the sleep you need before you get behind the wheel. Fortunately, there are steps you can take to improve your sleep health.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Read the steps to get better sleep (PDF)  ↓', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php require __DIR__ . '/drowsy-driving-prevention-week-survey.php'; ?>

<!-- wp:group {"metadata":{"name":"Share the survey"},"align":"full","className":"is-style-section-lightest-blue nsf-ddpw-section nsf-ddpw-band","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-ddpw-section nsf-ddpw-band" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-ddpw-grid-2","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-grid-2"><!-- wp:group {"className":"nsf-ddpw-box","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-box"><?php $nsf_ddpw_icon( 'download', 'nsf-ddpw-icon--orange' ); ?>

<!-- wp:heading {"level":3,"className":"is-style-card-heading"} -->
<h3 class="wp-block-heading is-style-card-heading"><?php esc_html_e( 'Spread the word about the risks of drowsy driving.', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-ddpw-text-sm"} -->
<p class="nsf-ddpw-text-sm"><?php esc_html_e( 'Drowsy driving affects everyone on the road. Download and share the study infographic with your friends and family.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"nsf-ddpw-box__actions"} -->
<div class="wp-block-buttons nsf-ddpw-box__actions"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Download the infographic (PDF)  ↓', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"nsf-ddpw-box","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-box"><!-- wp:group {"metadata":{"name":"Graphic"},"className":"nsf-ddpw-graphic","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-graphic"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Graphic', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php esc_html_e( '2025 Drowsy Driving Survey', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"is-style-card-heading"} -->
<h3 class="wp-block-heading is-style-card-heading"><?php esc_html_e( 'Drowsy driving is dangerously common—but it is preventable.', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-ddpw-text-sm"} -->
<p class="nsf-ddpw-text-sm"><?php esc_html_e( 'You can download our full Drowsy Driving Survey Report below to learn more about the results and how to help prevent drowsy driving.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"nsf-ddpw-box__actions"} -->
<div class="wp-block-buttons nsf-ddpw-box__actions"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Download and share the results (PDF)  ↓', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Drowsy driving resources"},"align":"full","className":"is-style-section-white nsf-ddpw-section nsf-ddpw-section--wide-gap","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-ddpw-section nsf-ddpw-section--wide-gap" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-ddpw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-stack"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'Sleep Health Topics', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Discover more drowsy driving resources.', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-ddpw-text-lg"} -->
<p class="nsf-ddpw-text-lg"><?php esc_html_e( 'Read on to learn more about how you can be safer behind the wheel by putting #SleepFirst.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Articles"},"className":"nsf-ddpw-grid-3","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-grid-3"><?php
$nsf_ddpw_card( 'assets/images/home/card-1.jpg', __( 'Protecting Your Family on the Road Starts at Home with Healthy Sleep', 'nsf' ), __( 'You might not realize that choosing to drive when not fully alert is a form of impaired driving.', 'nsf' ) );
$nsf_ddpw_card( 'assets/images/home/campaign-small-left.jpg', __( 'Sleep First to Prevent Drowsy Driving.', 'nsf' ), __( 'Drowsy driving is dangerous, but preventable. Learn some things you can do before getting behind the wheel.', 'nsf' ) );
$nsf_ddpw_card( 'assets/images/home/research.jpg', __( 'Signs and Symptoms of Drowsy Driving', 'nsf' ), __( 'Before getting into the car with someone or driving yourself, review our tips for preventing Drowsy Driving. Learn the 8 drowsy driving warning signs.', 'nsf' ) );
$nsf_ddpw_card( 'assets/images/home/campaign-small-right.jpg', __( 'Wait. Drowsy Driving is like Drunk Driving?', 'nsf' ), __( 'When people drive after sleeping four hours or less, it’s like driving drunk. Learn why teenagers are more susceptible to drowsy driving.', 'nsf' ) );
$nsf_ddpw_card( 'assets/images/home/hero-1.jpg', __( 'Sleep Health and Safety: Navigating the Road to Alert Driving', 'nsf' ), __( 'Understand how technological advancements can enhance two of the most critical aspects of our lives: healthy sleep and safe driving.', 'nsf' ) );
$nsf_ddpw_card( 'assets/images/home/campaign-large.jpg', __( 'Staying Alert on the Road After Work', 'nsf' ), __( 'If you work early mornings, late nights, or alternating shifts, you have a higher chance of drowsy driving. When you’re sleep-deprived, your motor functions and reaction time are impaired.', 'nsf' ) );
?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Sponsors and collaborators"},"align":"full","className":"is-style-section-lightest-blue nsf-ddpw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-ddpw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-ddpw-stack nsf-ddpw-stack--tight","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-stack nsf-ddpw-stack--tight"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Committed to drowsy driving prevention', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2","textColor":"primary-blue"} -->
<p class="is-style-paragraph-2 has-primary-blue-color has-text-color"><?php esc_html_e( 'Thank you to our sponsors and collaborators', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-ddpw-text-sm nsf-ddpw-measure"} -->
<p class="nsf-ddpw-text-sm nsf-ddpw-measure"><?php esc_html_e( 'NSF is proud to recognize our Drowsy Driving Prevention Week sponsors and collaborators who are demonstrating their commitment to sleep health and road safety.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Tier: Sponsors"},"className":"nsf-ddpw-tier","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-tier"><!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php esc_html_e( 'Sponsors', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"metadata":{"name":"Sponsor logos"},"className":"is-style-logos nsf-ddpw-logos nsf-ddpw-logos--lead","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-logos nsf-ddpw-logos nsf-ddpw-logos--lead"><?php $nsf_ddpw_logos( 5 ); ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Tier: Campaign collaborators"},"className":"nsf-ddpw-tier","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-tier"><!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php esc_html_e( 'Campaign collaborators', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"metadata":{"name":"Collaborator logos"},"className":"is-style-logos nsf-ddpw-logos","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-logos nsf-ddpw-logos"><?php $nsf_ddpw_logos( 14 ); ?></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Sponsorship opportunities"},"align":"full","className":"is-style-section-white nsf-ddpw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-ddpw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)">
<!-- wp:nsf/cta-row {"className":"nsf-ddpw-cta"} -->
<!-- wp:group {"className":"nsf-cta-row__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-cta-row__copy"><!-- wp:heading {"className":"nsf-ddpw-box__heading"} -->
<h2 class="wp-block-heading nsf-ddpw-box__heading"><?php esc_html_e( 'Sponsorship Opportunities', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-ddpw-text-lg"} -->
<p class="nsf-ddpw-text-lg"><?php esc_html_e( 'Committed to sleep health? Support the NSF.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/sponsorship-prospectus/"><?php esc_html_e( 'Download the prospectus  ↓', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- /wp:nsf/cta-row --></div>
<!-- /wp:group -->
