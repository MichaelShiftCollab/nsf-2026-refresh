<?php
/**
 * Title: Drowsy Driving Forum
 * Slug: nsf/drowsy-driving-prevention-week-forum
 * Categories: nsf-sections
 * Keywords: drowsy driving, forum, event, speakers, panels
 * Description: Navy band with the event's eyebrow, intro, date and place, three square graphics (a placeholder and two photo tiles with a caption) and a register button. Anchor "forum" for the Header Flag. Used on the Drowsy Driving Prevention Week® page.
 *
 * @package NSF
 */

/**
 * One square photo tile with a caption over a dark fade.
 *
 * @param string $image Theme image path.
 * @param string $label Small label.
 * @param string $title Tile title.
 */
$nsf_ddpw_tile = function ( $image, $label, $title ) {
	$nsf_url = get_theme_file_uri( $image );
	?>
<!-- wp:cover {"url":"<?php echo esc_url( $nsf_url ); ?>","dimRatio":0,"contentPosition":"bottom left","className":"nsf-ddpw-tile","layout":{"type":"default"}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-left nsf-ddpw-tile"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $nsf_url ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"className":"nsf-ddpw-tile__label"} -->
<p class="nsf-ddpw-tile__label"><?php echo esc_html( $label ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-ddpw-tile__title"} -->
<p class="nsf-ddpw-tile__title"><?php echo esc_html( $title ); ?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->
	<?php
};
?>
<!-- wp:group {"metadata":{"name":"Drowsy Driving Forum"},"align":"full","anchor":"forum","className":"is-style-section-primary-blue-to-dark-blue nsf-ddpw-section nsf-ddpw-band","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} -->
<div id="forum" class="wp-block-group alignfull is-style-section-primary-blue-to-dark-blue nsf-ddpw-section nsf-ddpw-band" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)"><!-- wp:group {"metadata":{"name":"Intro"},"className":"nsf-ddpw-stack nsf-ddpw-center nsf-ddpw-narrow","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-stack nsf-ddpw-center nsf-ddpw-narrow"><!-- wp:paragraph {"className":"is-style-eyebrow","textColor":"medium-orange"} -->
<p class="is-style-eyebrow has-medium-orange-color has-text-color"><?php esc_html_e( 'National Sleep Foundation’s Drowsy Driving Forum', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-ddpw-text-lg","textColor":"white"} -->
<p class="nsf-ddpw-text-lg has-white-color has-text-color"><?php esc_html_e( 'Join National Sleep Foundation and leaders from government, transportation, safety, technology, and public health for a national conversation on drowsy driving prevention.', 'nsf' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"medium-orange","style":{"typography":{"fontWeight":"700"}}} -->
<p class="has-medium-orange-color has-text-color" style="font-weight:700"><?php esc_html_e( 'Thursday, October 29, 2026 at 10am  |  National Press Club in Washington, D.C.', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Graphics"},"className":"nsf-ddpw-grid-3","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-grid-3"><!-- wp:group {"metadata":{"name":"Forum graphic"},"className":"nsf-ddpw-tile nsf-ddpw-tile--placeholder","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-ddpw-tile nsf-ddpw-tile--placeholder"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Forum graphic', 'nsf' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php
$nsf_ddpw_tile( 'assets/images/home/research.jpg', __( 'Speaker graphic', 'nsf' ), __( 'Leadership Panel', 'nsf' ) );
$nsf_ddpw_tile( 'assets/images/home/card-1.jpg', __( 'Speaker graphic', 'nsf' ), __( 'Solutions & Actions Panel', 'nsf' ) );
?></div>
<!-- /wp:group -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Learn more and register to attend  →', 'nsf' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
