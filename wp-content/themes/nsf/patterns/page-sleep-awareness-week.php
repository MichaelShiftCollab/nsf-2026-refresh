<?php
/**
 * Title: Page: Sleep Awareness Week®
 * Slug: nsf/page-sleep-awareness-week
 * Categories: nsf-pages
 * Post Types: page
 * Keywords: sleep awareness week, campaign, page
 * Description: Sleep Awareness Week® page body for the "No Title" template: title band with an eyebrow, intro, why we do it, Best Slept Self®, Sleep Learning Zone® articles, the Sleep in America® Poll and its findings, the poll report CTA, sponsors, collaborators and the Participation Toolkit. Placeholder copy from the mockup.
 *
 * @package NSF
 */

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
?>
<!-- wp:group {"metadata":{"name":"Title band"},"align":"full","className":"is-style-section-title-band nsf-title-band","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-title-band nsf-title-band"><!-- wp:nsf/breadcrumbs /-->

<!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php esc_html_e( 'Sleep Awareness Week®  ·  March 8–14, 2026', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'It’s time to be your Best Slept Self', 'nsf' ); ?><sup>®</sup></h1>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Intro"},"align":"full","className":"is-style-section-white nsf-saw-section nsf-saw-intro","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-saw-section nsf-saw-intro" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-saw-split","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-split"><!-- wp:group {"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:paragraph {"className":"is-style-paragraph-2","textColor":"primary-blue"} -->
<p class="is-style-paragraph-2 has-primary-blue-color has-text-color"><?php esc_html_e( 'Every year, the National Sleep Foundation takes this time to reemphasize the important connection between your sleep and your health and well-being.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link nsf-saw-actions"} -->
<p class="is-style-link nsf-saw-actions"><a href="#about"><?php esc_html_e( 'Learn about Sleep Awareness Week', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-saw-photo nsf-photo"} -->
<figure class="wp-block-image size-full nsf-saw-photo nsf-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/home/campaign-large.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Advancing sleep health"},"align":"full","anchor":"about","className":"is-style-section-lightest-blue nsf-saw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div id="about" class="wp-block-group alignfull is-style-section-lightest-blue nsf-saw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Advancing sleep health for all', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"nsf-saw-columns","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-columns"><!-- wp:group {"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:heading {"level":3,"className":"is-style-card-heading"} -->
<h3 class="wp-block-heading is-style-card-heading"><?php esc_html_e( 'Why do we do it?', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Sleep is tied to nearly every part of health, and every year our polling shows how the nation is actually sleeping. Sleep Awareness Week® is when we put those findings in front of the public.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:heading {"level":3,"className":"is-style-card-heading"} -->
<h3 class="wp-block-heading is-style-card-heading"><?php esc_html_e( 'What’s the National Sleep Foundation all about?', 'nsf' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Short answer? Your sleep. We’ve been studying and reporting on it for over 35 years, and turning what we learn into guidance anyone can use.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link"} -->
<p class="is-style-link"><a href="/about-us/"><?php esc_html_e( 'Get to know the NSF', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Best Slept Self"},"align":"full","className":"is-style-section-white nsf-saw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-saw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"className":"nsf-saw-split","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-split"><!-- wp:group {"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'Best Slept Self®', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Be your Best Slept Self', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-saw-text-lg"} -->
<p class="nsf-saw-text-lg"><?php esc_html_e( 'See a renewed you after taking small steps each day and night that make a big difference in sleep health.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"nsf-saw-actions"} -->
<div class="wp-block-buttons nsf-saw-actions"><!-- wp:button {"textColor":"primary-orange","className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-primary-orange-color has-text-color wp-element-button" href="#"><?php esc_html_e( 'Read how to get better sleep (PDF)  ↓', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"nsf-saw-placeholder","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-placeholder"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Infographic', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Sleep Learning Zone articles"},"align":"full","className":"nsf-saw-section nsf-saw-fade","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nsf-saw-section nsf-saw-fade" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'Sleep Learning Zone®', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Discover NSF sleep resources', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-saw-text-lg nsf-saw-measure"} -->
<p class="nsf-saw-text-lg nsf-saw-measure"><?php esc_html_e( 'We translate our research into guidance you can use. Start with these articles from the Sleep Learning Zone®.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php
$nsf_cards = array( 'count' => 8, 'columns' => 4, 'category' => '', 'excerpt' => false, 'date' => false, 'compact' => true, 'link' => __( 'Learn more', 'nsf' ) );
require __DIR__ . '/../inc/post-cards.php';
?>

<!-- wp:paragraph {"className":"is-style-link"} -->
<p class="is-style-link"><a href="/sleep-health-resources/sleep-learning-zone/"><?php esc_html_e( 'Read our Sleep Health Topics blog', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php require __DIR__ . '/sleep-awareness-week-poll.php'; ?>

<!-- wp:group {"metadata":{"name":"Poll report CTA"},"align":"full","className":"is-style-section-white nsf-saw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-saw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)">
<!-- wp:nsf/cta-row {"className":"nsf-saw-cta"} -->
<!-- wp:group {"className":"nsf-cta-row__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-cta-row__copy"><!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php esc_html_e( 'Learn even more', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Check out the National Sleep Foundation’s full Sleep in America® Poll Report', 'nsf' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/research/nsf-research-reports/sleep-in-america-polls/"><?php esc_html_e( 'Download the 2026 Poll Results', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- /wp:nsf/cta-row --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Sponsors"},"align":"full","className":"is-style-section-lightest-blue nsf-saw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-lightest-blue nsf-saw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Committed to sleep health', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2","textColor":"primary-blue"} -->
<p class="is-style-paragraph-2 has-primary-blue-color has-text-color"><?php esc_html_e( 'Thank you to our sponsors', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Sponsor logos"},"className":"is-style-logos nsf-saw-logos","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-logos nsf-saw-logos"><?php $nsf_saw_logos( 16 ); ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Collaborators"},"align":"full","className":"is-style-section-white nsf-saw-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-white nsf-saw-section" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-saw-stack","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-saw-stack"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'We appreciate our collaborators', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-2","textColor":"primary-blue"} -->
<p class="is-style-paragraph-2 has-primary-blue-color has-text-color"><?php esc_html_e( 'The following organizations and agencies helped disseminate our educational information.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Collaborator logos"},"className":"is-style-logos nsf-saw-logos nsf-saw-logos--7","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-logos nsf-saw-logos nsf-saw-logos--7"><?php $nsf_saw_logos( 14 ); ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Participation Toolkit"},"align":"full","className":"is-style-section-light-blue-to-light-orange nsf-saw-toolkit","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-light-blue-to-light-orange nsf-saw-toolkit" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)">
<!-- wp:nsf/cta-form {"formKey":"participation-toolkit"} -->
<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'Participation Toolkit', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Sleep Awareness Week', 'nsf' ); ?><sup>®</sup> <?php esc_html_e( 'Participation Toolkit', 'nsf' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-saw-text-md"} -->
<p class="nsf-saw-text-md"><?php esc_html_e( 'Help everyone be their Best Slept Self.® Share sleep health resources with friends, family and colleagues. Complete the form to get the Participation Toolkit — we’ll reach out after the campaign to see how you used the materials.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:nsf/cta-form --></div>
<!-- /wp:group -->
