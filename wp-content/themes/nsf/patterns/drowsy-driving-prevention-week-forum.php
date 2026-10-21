<?php
/**
 * Title: Drowsy Driving Forum
 * Slug: nsf/drowsy-driving-prevention-week-forum
 * Categories: nsf-sections
 * Keywords: drowsy driving, forum, event, speakers, panels
 * Description: Lightest Blue band with the event's eyebrow, intro, date and place, three square event graphics (the forum and its two panels) and a register button. Anchor "forum" for the Hanging tab. Used on the Drowsy Driving Prevention Week® page.
 *
 * @package NSF
 */

/**
 * One square event graphic.
 *
 * @param string $file File name in the page's image folder.
 * @param string $alt  Alt text.
 */
$nsf_ddpw_graphic = function ( $file, $alt ) {
	$nsf_url = get_theme_file_uri( 'assets/images/drowsy-driving-prevention-week/' . $file );
	?>
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-ddpw-forum__graphic"} -->
<figure class="wp-block-image size-full nsf-ddpw-forum__graphic"><img src="<?php echo esc_url( $nsf_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>"/></figure>
<!-- /wp:image -->
	<?php
};
?>
<!-- wp:group {"metadata":{"name":"Drowsy Driving Forum"},"align":"full","anchor":"forum","className":"is-style-section-lightest-blue nsf-ddpw-section nsf-ddpw-forum","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div id="forum" class="wp-block-group alignfull is-style-section-lightest-blue nsf-ddpw-section nsf-ddpw-forum" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Heading group"},"className":"nsf-ddpw-stack nsf-ddpw-center nsf-ddpw-narrow","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-stack nsf-ddpw-center nsf-ddpw-narrow"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow"><?php esc_html_e( 'National Sleep Foundation’s Drowsy Driving Forum', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim"} -->
<p class="is-style-paragraph-2 nsf-trim"><?php esc_html_e( 'Join National Sleep Foundation and leaders from government, transportation, safety, technology, and public health for a national conversation on drowsy driving prevention.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-paragraph-2 nsf-trim nsf-ddpw-forum__details","textColor":"primary-blue"} -->
<p class="is-style-paragraph-2 nsf-trim nsf-ddpw-forum__details has-primary-blue-color has-text-color"><?php esc_html_e( 'Thursday, October 29, 2026 at 10am  |  National Press Club in Washington, D.C.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Event graphics"},"className":"nsf-ddpw-grid-3","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-grid-3"><?php
$nsf_ddpw_graphic( 'forum-graphic.png', __( '2026 Drowsy Driving Forum: Advancing Sleep Health to Reduce Impaired Driving. October 29, 2026, National Press Club, Washington, DC.', 'nsf' ) );
$nsf_ddpw_graphic( 'forum-leadership-panel.png', __( 'Leadership Panel: Jonathan Morrison, Thomas Chapman and John Bozzella, moderated by Mark R. Rosekind, PhD.', 'nsf' ) );
$nsf_ddpw_graphic( 'forum-solutions-panel.png', __( 'Solutions & Actions Panel, moderated by Mark R. Rosekind, PhD: Jonathan Adkins, David Harkey, Fariha Abbasi-Feinberg, MD, Joseph Dzierzewski, PhD, and Jamie Butters.', 'nsf' ) );
?></div>
<!-- /wp:group -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Learn more and register to attend  →', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
