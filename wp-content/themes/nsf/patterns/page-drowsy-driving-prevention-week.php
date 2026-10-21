<?php
/**
 * Title: Page: Drowsy Driving Prevention Week®
 * Slug: nsf/page-drowsy-driving-prevention-week
 * Categories: nsf-pages
 * Post Types: page
 * Keywords: drowsy driving, campaign, page
 * Description: Drowsy Driving Prevention Week® page body for the "No Title" template (mockup 519:270): the Drowsy Driving Forum hanging tab, campaign hero with logo and photo cluster, the Drowsy Driving Forum, three risk illustrations, better sleep, the 2025 survey and its key results, two downloads, Sleep Health Topics articles, sponsors and collaborators, and sponsorship. Placeholder copy from the mockup.
 *
 * @package NSF
 */

/**
 * Theme image URL in this page's image folder.
 *
 * @param string $file File name.
 * @return string
 */
$nsf_ddpw_img = static fn( $file ) => get_theme_file_uri( 'assets/images/drowsy-driving-prevention-week/' . $file );

/**
 * A decorative image block (illustration or icon) with a size class.
 *
 * @param string $file    File name in the page's image folder.
 * @param string $classes Extra classes.
 */
$nsf_ddpw_art = function ( $file, $classes ) use ( $nsf_ddpw_img ) {
	$nsf_class = 'nsf-ddpw-art ' . $classes;
	?>
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"<?php echo esc_attr( $nsf_class ); ?>"} -->
<figure class="wp-block-image size-full <?php echo esc_attr( $nsf_class ); ?>"><img src="<?php echo esc_url( $nsf_ddpw_img( $file ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
	<?php
};

/**
 * One risk column: illustration, heading and text.
 *
 * @param string $file  Illustration file name.
 * @param string $title Heading.
 * @param string $text  Text.
 */
$nsf_ddpw_reason = function ( $file, $title, $text ) use ( $nsf_ddpw_art ) {
	?>
<!-- wp:group {"className":"nsf-ddpw-reason","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-reason"><?php $nsf_ddpw_art( $file, 'nsf-ddpw-art--200' ); ?>

<!-- wp:heading {"level":3,"className":"is-style-card-heading nsf-trim"} -->
<h3 class="wp-block-heading is-style-card-heading nsf-trim"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php echo esc_html( $text ); ?></p>
<!-- /wp:paragraph --></div>
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
<?php require __DIR__ . '/hanging-tab.php'; ?>

<!-- wp:group {"metadata":{"name":"Campaign hero"},"align":"full","className":"nsf-ddpw-hero","gradient":"light-multi","textColor":"gray","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nsf-ddpw-hero has-gray-color has-light-multi-gradient-background has-text-color has-background" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-ddpw-hero__grid","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-hero__grid"><!-- wp:group {"className":"nsf-ddpw-hero__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-hero__copy"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-ddpw-hero__logo"} -->
<figure class="wp-block-image size-full nsf-ddpw-hero__logo"><img src="<?php echo esc_url( $nsf_ddpw_img( 'ddpw-logo.png' ) ); ?>" alt="<?php esc_attr_e( 'National Sleep Foundation’s Drowsy Driving Prevention Week®', 'nsf' ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'Drowsy Driving Prevention Week®  ·  November 1–7, 2026', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Sleep First. Drive Alert.®', 'nsf' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'The National Sleep Foundation’s Drowsy Driving Prevention Week® encourages everyone to prioritize sleep and drive when they are alert and refreshed. Our goal is to help people get the sleep they need and reduce the number of drivers who choose to drive while sleep-deprived.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'Together, we can help people drive alert and work to prevent thousands of motor vehicle crashes each year.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim nsf-ddpw-hero__note"} -->
<p class="is-style-paragraph-2 nsf-trim nsf-ddpw-hero__note"><?php esc_html_e( 'Save the date: NSF will hold a Drowsy Driving Forum in Washington, DC on October 29.', 'nsf' ); ?> <a href="#forum"><?php esc_html_e( 'View the program agenda and registration information here.', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Photo cluster"},"className":"nsf-photo-cluster nsf-ddpw-cluster","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-photo-cluster nsf-ddpw-cluster"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-photo-cluster__large nsf-photo"} -->
<figure class="wp-block-image size-full nsf-photo-cluster__large nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/home/campaign-large.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-photo-cluster__right nsf-photo"} -->
<figure class="wp-block-image size-full nsf-photo-cluster__right nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/home/campaign-small-right.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-photo-cluster__left nsf-photo"} -->
<figure class="wp-block-image size-full nsf-photo-cluster__left nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/home/campaign-small-left.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php require __DIR__ . '/drowsy-driving-prevention-week-forum.php'; ?>

<!-- wp:group {"metadata":{"name":"Fall-asleep crashes"},"align":"full","className":"is-style-section-white nsf-ddpw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-ddpw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-ddpw-stack nsf-ddpw-crashes__heading","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-stack nsf-ddpw-crashes__heading"><!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->
<p class="has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Drowsy Driving Prevention Week 2026', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Fall-asleep crashes are often caused by not getting the sleep you need', 'nsf' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Risks"},"className":"nsf-ddpw-grid-3 nsf-ddpw-grid-3--wide","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-grid-3 nsf-ddpw-grid-3--wide"><?php
$nsf_ddpw_reason( 'illustration-risk.png', __( 'Drowsy driving is more likely to cause a crash.', 'nsf' ), __( 'Just like drunk, drugged, and distracted driving, drowsy driving is a real public health issue, causing thousands of car crashes each year and killing an estimated 6,400 people in the U.S. alone according to the AAA Foundation for Traffic Safety. 95% of Americans recognize that drowsy driving is dangerous yet nearly two-thirds of Americans report that they have driven while drowsy.', 'nsf' ) );
$nsf_ddpw_reason( 'illustration-risky.png', __( 'Drowsy driving is really risky.', 'nsf' ), __( 'When you drive without adequate sleep, your motor skills are seriously impaired. In fact, we’ll go as far as saying that drivers who’ve only slept 3 to 5 hours in the last 24 hours are unfit to drive. Most people understand it’s risky, but they don’t think about the consequences.', 'nsf' ) );
$nsf_ddpw_reason( 'illustration-prevalence.png', __( 'Drowsy driving is dangerously common.', 'nsf' ), __( 'Young drivers (aged 16-25 years) and shift workers are at greatest risk of falling asleep behind the wheel, but most drivers can relate to a time when they have nodded off while driving. Importantly, drowsy driving is preventable.', 'nsf' ) );
?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Get the sleep you need"},"align":"full","className":"is-style-section-light-orange nsf-ddpw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-light-orange nsf-ddpw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-ddpw-box nsf-ddpw-box--feature","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-box nsf-ddpw-box--feature"><?php $nsf_ddpw_art( 'icon-best-slept-self.png', 'nsf-ddpw-art--88' ); ?>

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Get the sleep you need to be alert and refreshed when you drive', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"is-style-paragraph-2 nsf-trim"} -->
<p class="has-text-align-center is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'Being your Best Slept Self® is important so you can get the sleep you need before you get behind the wheel. Fortunately, there are steps you can take to improve your sleep health.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Read the steps to get better sleep (PDF)  ↓', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php require __DIR__ . '/drowsy-driving-prevention-week-survey.php'; ?>

<!-- wp:group {"metadata":{"name":"Share the survey"},"align":"full","className":"is-style-section-lightest-blue nsf-ddpw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-ddpw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-ddpw-grid-2","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-grid-2"><!-- wp:group {"className":"nsf-ddpw-box","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-box"><?php $nsf_ddpw_art( 'icon-connection-inverse.png', 'nsf-ddpw-art--circle' ); ?>

<!-- wp:heading {"level":3,"className":"is-style-card-heading nsf-trim"} -->
<h3 class="wp-block-heading is-style-card-heading nsf-trim"><?php esc_html_e( 'Spread the word about the risks of drowsy driving.', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'Drowsy driving affects everyone on the road. Download and share the study infographic with your friends and family.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Download the infographic (PDF)  ↓', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"nsf-ddpw-box","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-box"><?php $nsf_ddpw_art( 'icon-report.png', 'nsf-ddpw-art--report' ); ?>

<!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->
<p class="has-text-align-center is-style-eyebrow"><?php esc_html_e( '2025 Drowsy Driving Survey', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"is-style-card-heading nsf-trim"} -->
<h3 class="wp-block-heading is-style-card-heading nsf-trim"><?php esc_html_e( 'Drowsy driving is dangerously common—but it is preventable.', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'You can download our full Drowsy Driving Survey Report below to learn more about the results and how to help prevent drowsy driving.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-secondary"} -->
<div class="wp-block-button is-style-secondary"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Download and share the results (PDF)  ↓', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Drowsy driving resources"},"align":"full","className":"is-style-section-white nsf-ddpw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-ddpw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-ddpw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-stack"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'Sleep Health Topics', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Discover more drowsy driving resources.', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'Read on to learn more about how you can be safer behind the wheel by putting #SleepFirst.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php
$nsf_cards = array( 'count' => 6, 'columns' => 3, 'category' => 'drowsy-driving', 'excerpt' => true, 'date' => false, 'compact' => false, 'link' => __( 'Learn more', 'nsf' ) );
require __DIR__ . '/../inc/post-cards.php';
?></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Sponsors and collaborators"},"align":"full","className":"is-style-section-lightest-blue nsf-ddpw-section nsf-ddpw-sponsors","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-ddpw-section nsf-ddpw-sponsors" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-ddpw-stack nsf-ddpw-center","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-stack nsf-ddpw-center"><?php $nsf_ddpw_art( 'icon-partnership.png', 'nsf-ddpw-art--partnership' ); ?>

<!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Committed to drowsy driving prevention', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"nsf-ddpw-subhead nsf-trim"} -->
<p class="has-text-align-center nsf-ddpw-subhead nsf-trim"><?php esc_html_e( 'Thank you to our sponsors and collaborators', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"nsf-ddpw-measure nsf-trim"} -->
<p class="has-text-align-center nsf-ddpw-measure nsf-trim"><?php esc_html_e( 'NSF is proud to recognize our Drowsy Driving Prevention Week sponsors and collaborators who are demonstrating their commitment to sleep health and road safety.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Tier: Sponsors"},"className":"nsf-ddpw-tier","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-tier"><!-- wp:paragraph {"className":"is-style-eyebrow-small","textColor":"primary-blue"} -->
<p class="is-style-eyebrow-small has-primary-blue-color has-text-color"><?php esc_html_e( 'Sponsors', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"metadata":{"name":"Sponsor logos"},"className":"is-style-logos nsf-ddpw-logos","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-logos nsf-ddpw-logos"><?php $nsf_ddpw_logos( 5 ); ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Tier: Campaign collaborators"},"className":"nsf-ddpw-tier","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-tier"><!-- wp:paragraph {"className":"is-style-eyebrow-small","textColor":"primary-blue"} -->
<p class="is-style-eyebrow-small has-primary-blue-color has-text-color"><?php esc_html_e( 'Campaign collaborators', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"metadata":{"name":"Collaborator logos"},"className":"is-style-logos nsf-ddpw-logos","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-logos nsf-ddpw-logos"><?php $nsf_ddpw_logos( 14 ); ?></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Sponsorship opportunities"},"align":"full","className":"is-style-section-primary-blue-to-dark-blue nsf-ddpw-section nsf-ddpw-sponsorship","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-primary-blue-to-dark-blue nsf-ddpw-section nsf-ddpw-sponsorship" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Sponsorship Opportunities', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'Committed to sleep health? Support the NSF.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/sponsorship-prospectus/"><?php esc_html_e( 'Download the prospectus  ↓', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
