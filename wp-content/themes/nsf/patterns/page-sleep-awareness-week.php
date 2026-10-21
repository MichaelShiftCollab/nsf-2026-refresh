<?php
/**
 * Title: Page: Sleep Awareness Week®
 * Slug: nsf/page-sleep-awareness-week
 * Categories: nsf-pages
 * Post Types: page
 * Keywords: sleep awareness week, campaign, page
 * Description: Sleep Awareness Week® page body for the "No Title" template (mockup 505:154): campaign hero with the logo and a photo cluster, advancing sleep health, Best Slept Self®, Sleep Learning Zone® articles, the Sleep in America® Poll and its findings, the poll report CTA, sponsors, collaborators and the Participation Toolkit. Placeholder copy from the mockup.
 *
 * @package NSF
 */

/**
 * An image from assets/images/sleep-awareness-week.
 *
 * @param string $file    File name.
 * @param string $classes Classes; size and position come from the page stylesheet.
 * @param string $alt     Alternative text ('' for decorative images).
 */
$nsf_saw_image = function ( $file, $classes, $alt = '' ) {
	?>
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"<?php echo esc_attr( $classes ); ?>"} -->
<figure class="wp-block-image size-full <?php echo esc_attr( $classes ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/sleep-awareness-week/' . $file ) ); ?>" alt="<?php echo esc_attr( $alt ); ?>"/></figure>
<!-- /wp:image -->
	<?php
};

/**
 * Logo placeholders for a logo grid.
 *
 * @param int $count Number of logos.
 */
$nsf_saw_logos = function ( $count ) {
	for ( $nsf_i = 0; $nsf_i < $count; $nsf_i++ ) {
		?>
<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo-placeholder.svg' ) ); ?>" alt="<?php esc_attr_e( 'Company name', 'nsf' ); ?>"/></figure>
<!-- /wp:image -->
		<?php
	}
};

$nsf_saw_home_image = fn( $file ) => esc_url( get_theme_file_uri( 'assets/images/home/' . $file ) );
?>
<!-- wp:group {"metadata":{"name":"Campaign hero"},"align":"full","className":"nsf-saw-hero","gradient":"light-multi","textColor":"gray","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nsf-saw-hero has-gray-color has-light-multi-gradient-background has-text-color has-background" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-saw-hero__grid","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-hero__grid"><!-- wp:group {"className":"nsf-saw-stack nsf-saw-hero__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack nsf-saw-hero__copy"><?php $nsf_saw_image( 'saw-2026-logo-horizontal.png', 'nsf-saw-logo nsf-saw-logo--hero', __( 'Sleep Awareness Week® 2026, powered by the National Sleep Foundation', 'nsf' ) ); ?>

<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'Sleep Awareness Week®  ·  March 8–14, 2026', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'It’s time to be your Best Slept Self®', 'nsf' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'Every year, the National Sleep Foundation takes this time to reemphasize the important connection between your sleep and your health and well-being.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link nsf-trim"} -->
<p class="is-style-link nsf-trim"><a href="#about"><?php esc_html_e( 'Learn about Sleep Awareness Week', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Photo cluster"},"className":"nsf-photo-cluster nsf-saw-cluster","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-photo-cluster nsf-saw-cluster"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-photo-cluster__large nsf-photo"} -->
<figure class="wp-block-image size-full nsf-photo-cluster__large nsf-photo"><img src="<?php echo $nsf_saw_home_image( 'campaign-large.jpg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-photo-cluster__right nsf-photo"} -->
<figure class="wp-block-image size-full nsf-photo-cluster__right nsf-photo"><img src="<?php echo $nsf_saw_home_image( 'campaign-small-right.jpg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-photo-cluster__left nsf-photo"} -->
<figure class="wp-block-image size-full nsf-photo-cluster__left nsf-photo"><img src="<?php echo $nsf_saw_home_image( 'campaign-small-left.jpg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Advancing sleep health"},"align":"full","anchor":"about","className":"is-style-section-white nsf-saw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div id="about" class="wp-block-group alignfull is-style-section-white nsf-saw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><?php $nsf_saw_image( 'sun-moon-badge.png', 'nsf-saw-badge' ); ?>

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Advancing sleep health for all', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"nsf-saw-columns","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-columns"><!-- wp:group {"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:heading {"level":3,"className":"is-style-card-heading nsf-trim"} -->
<h3 class="wp-block-heading is-style-card-heading nsf-trim"><?php esc_html_e( 'Why do we do it?', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'Sleep is tied to nearly every part of health, and every year our polling shows how the nation is actually sleeping. Sleep Awareness Week® is when we put those findings in front of the public.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:heading {"level":3,"className":"is-style-card-heading nsf-trim"} -->
<h3 class="wp-block-heading is-style-card-heading nsf-trim"><?php esc_html_e( 'What’s the National Sleep Foundation all about?', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'Short answer? Your sleep. We’ve been studying and reporting on it for over 35 years, and turning what we learn into guidance anyone can use.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link nsf-trim"} -->
<p class="is-style-link nsf-trim"><a href="/mission-and-goals/"><?php esc_html_e( 'Get to know the NSF', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Best Slept Self"},"align":"full","className":"is-style-section-light-blue-to-white nsf-saw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-light-blue-to-white nsf-saw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-saw-split","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-split"><!-- wp:group {"className":"nsf-saw-stack nsf-saw-stack--18","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack nsf-saw-stack--18"><?php $nsf_saw_image( 'best-slept-self-logo.png', 'nsf-saw-logo nsf-saw-logo--bss', __( 'Best Slept Self®', 'nsf' ) ); ?>

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Be your Best Slept Self', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'See a renewed you after taking small steps each day and night that make a big difference in sleep health.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-saw-download nsf-trim"} -->
<p class="nsf-saw-download nsf-trim"><a href="#"><?php esc_html_e( 'Read how to get better sleep (PDF)', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Infographic placeholder"},"className":"nsf-saw-placeholder","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-placeholder"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Infographic', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Sleep Learning Zone articles"},"align":"full","className":"is-style-section-white nsf-saw-section nsf-saw-articles","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-saw-section nsf-saw-articles" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-saw-stack nsf-saw-stack--20","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack nsf-saw-stack--20"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Discover NSF sleep resources', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim nsf-saw-measure"} -->
<p class="is-style-paragraph-2 nsf-trim nsf-saw-measure"><?php esc_html_e( 'We translate our research into guidance you can use. Start with these articles from the Sleep Learning Zone®.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php
$nsf_cards = array( 'count' => 8, 'columns' => 4, 'category' => '', 'excerpt' => false, 'date' => false, 'compact' => true, 'link' => __( 'Learn more', 'nsf' ) );
require __DIR__ . '/../inc/post-cards.php';
?>

<!-- wp:paragraph {"className":"is-style-link nsf-trim"} -->
<p class="is-style-link nsf-trim"><a href="/sleep-health-resources/sleep-health-topics/"><?php esc_html_e( 'Read our Sleep Health Topics blog', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php require __DIR__ . '/sleep-awareness-week-poll.php'; ?>

<!-- wp:group {"metadata":{"name":"Poll report CTA"},"align":"full","className":"is-style-section-primary-blue-to-dark-blue nsf-saw-section nsf-saw-cta","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-primary-blue-to-dark-blue nsf-saw-section nsf-saw-cta" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:paragraph {"className":"is-style-eyebrow","textColor":"medium-orange"} -->
<p class="is-style-eyebrow has-medium-orange-color has-text-color"><?php esc_html_e( 'Learn even more', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"nsf-saw-heading-narrow"} -->
<h2 class="wp-block-heading nsf-saw-heading-narrow"><?php esc_html_e( 'Check out the National Sleep Foundation’s full Sleep in America® Poll Report', 'nsf' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/research/nsf-research-reports/sleep-in-america-polls/"><?php esc_html_e( 'Download the 2026 Poll Results', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Sponsors"},"align":"full","className":"is-style-section-lightest-blue nsf-saw-section nsf-saw-section--logos","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-saw-section nsf-saw-section--logos" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:heading {"className":"nsf-saw-logos-heading"} -->
<h2 class="wp-block-heading nsf-saw-logos-heading"><?php esc_html_e( 'Committed to sleep health', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'Thank you to our sponsors', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Sponsor logos"},"className":"is-style-logos nsf-saw-logos","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-logos nsf-saw-logos"><?php $nsf_saw_logos( 16 ); ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Collaborators"},"align":"full","className":"is-style-section-white nsf-saw-section nsf-saw-section--logos","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-saw-section nsf-saw-section--logos" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:heading {"className":"nsf-saw-logos-heading"} -->
<h2 class="wp-block-heading nsf-saw-logos-heading"><?php esc_html_e( 'We appreciate our collaborators', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-trim"} -->
<p class="nsf-trim"><?php esc_html_e( 'The following organizations and agencies helped disseminate our educational information.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Collaborator logos"},"className":"is-style-logos nsf-saw-logos nsf-saw-logos--7","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-logos nsf-saw-logos nsf-saw-logos--7"><?php $nsf_saw_logos( 13 ); ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php require __DIR__ . '/participation-toolkit.php'; ?>
