<?php
/**
 * Title: Page: National Programs
 * Slug: nsf/page-national-programs
 * Categories: nsf-pages
 * Post Types: page
 * Keywords: national programs, campaigns, page
 * Description: National Programs page body for the "No Title" template (Figma 497:60, hero option A): dark blue hero with a two-photo cluster, three campaign cards, Reshaping Employee Wellness and Key Issues rows. Placeholder copy from the mockup.
 *
 * @package NSF
 */

/**
 * One campaign card: photo, date eyebrow, title, text and a link.
 *
 * @param string $image   Theme image path.
 * @param string $eyebrow Date or label.
 * @param string $title   Card title.
 * @param string $text    Short description.
 * @param string $url     Link URL.
 */
$nsf_np_card = function ( $image, $eyebrow, $title, $text, $url ) {
	?>
<!-- wp:group {"className":"nsf-np-card","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-card"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-np-card__image nsf-photo"} -->
<figure class="wp-block-image size-full nsf-np-card__image nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( $image ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"nsf-np-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-card__body"><!-- wp:group {"className":"nsf-np-card__text","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-card__text"><!-- wp:paragraph {"className":"is-style-eyebrow-small nsf-trim"} -->
<p class="is-style-eyebrow-small nsf-trim"><?php echo esc_html( $eyebrow ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"is-style-card-heading nsf-trim"} -->
<h3 class="wp-block-heading is-style-card-heading nsf-trim"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php echo esc_html( $text ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"is-style-link nsf-trim"} -->
<p class="is-style-link nsf-trim"><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Learn more', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
	<?php
};
?>
<!-- wp:group {"metadata":{"name":"Hero"},"align":"full","className":"nsf-np-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nsf-np-hero"><!-- wp:group {"className":"nsf-np-hero__grid","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-hero__grid"><!-- wp:group {"className":"nsf-np-hero__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-hero__copy"><!-- wp:heading {"level":1,"textColor":"white"} -->
<h1 class="wp-block-heading has-white-color has-text-color"><?php esc_html_e( 'National Programs', 'nsf' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim","textColor":"white"} -->
<p class="is-style-paragraph-2 nsf-trim has-white-color has-text-color"><?php esc_html_e( 'NSF’s national programs bring sleep health to the public — annual campaigns that reach millions, a workplace initiative for employers, and the issues we work on year-round.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-np-note nsf-trim","textColor":"white"} -->
<p class="nsf-np-note nsf-trim has-white-color has-text-color"><?php esc_html_e( 'Placeholder copy throughout — page content in development', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Photo cluster"},"className":"nsf-np-cluster","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-cluster"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-np-cluster__large nsf-photo"} -->
<figure class="wp-block-image size-full nsf-np-cluster__large nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/home/research.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-np-cluster__small nsf-photo"} -->
<figure class="wp-block-image size-full nsf-np-cluster__small nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/home/hero-1.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Campaigns and programs"},"align":"full","className":"is-style-section-lightest-blue nsf-np-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-np-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-np-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-stack"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'For everyone', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Campaigns and programs', 'nsf' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Cards"},"className":"nsf-np-cards","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-cards"><?php
$nsf_np_card( 'assets/images/home/campaign-large.jpg', __( 'March 8–14, 2026', 'nsf' ), __( 'Sleep Awareness Week®', 'nsf' ), __( 'Our annual observance of the connection between sleep and health, anchored by the Sleep in America® Poll.', 'nsf' ), '/national-programs/sleep-awareness-week/' );
$nsf_np_card( 'assets/images/home/campaign-small-left.jpg', __( 'November 1–7, 2026', 'nsf' ), __( 'Drowsy Driving Prevention Week®', 'nsf' ), __( 'Sleep First. Drive Alert.® — a week focused on the risk of driving while sleep-deprived.', 'nsf' ), '/national-programs/drowsy-driving-prevention/' );
$nsf_np_card( 'assets/images/home/campaign-small-right.jpg', __( 'Year-round', 'nsf' ), __( 'Best Slept Self®', 'nsf' ), __( 'Six small steps, day and night, that add up to better sleep health.', 'nsf' ), '/national-programs/best-slept-self/' );
?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Reshaping Employee Wellness"},"align":"full","className":"is-style-section-white nsf-np-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-np-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-np-row","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-row"><!-- wp:group {"className":"nsf-np-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-stack"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'For employers', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Reshaping Employee Wellness', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-np-text-lg nsf-trim"} -->
<p class="nsf-np-text-lg nsf-trim"><?php esc_html_e( 'Sleep belongs in workplace wellness. This program gives employers the research, guidance and materials to make sleep health part of how their people are supported.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"nsf-np-actions"} -->
<div class="wp-block-buttons nsf-np-actions"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/national-programs/employee-wellness/"><?php esc_html_e( 'Learn about the program', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-np-photo nsf-photo"} -->
<figure class="wp-block-image size-full nsf-np-photo nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/home/campaign-small-left.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Key Issues"},"align":"full","className":"is-style-section-white nsf-np-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-np-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-np-row nsf-np-row--flip","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-row nsf-np-row--flip"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-np-photo nsf-photo"} -->
<figure class="wp-block-image size-full nsf-np-photo nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/home/card-1.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"nsf-np-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-np-stack"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'Advocacy', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Key Issues', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-np-text-lg nsf-trim"} -->
<p class="nsf-np-text-lg nsf-trim"><?php esc_html_e( 'The sleep health issues NSF works on year-round — drowsy driving, school start times, sleep health equity — with the position statements and research behind each one.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link nsf-np-actions nsf-trim"} -->
<p class="is-style-link nsf-np-actions nsf-trim"><a href="/national-programs/issues/"><?php esc_html_e( 'See our key issues', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
