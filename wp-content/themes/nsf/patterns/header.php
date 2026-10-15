<?php
/**
 * Title: Header
 * Slug: nsf/header
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 * Description: Alert Banner, logo, utility menu with search, and main menu (Header mockup 464:22). Below 1100px the menus move into one menu button.
 *
 * @package NSF
 */

$nsf_link = fn( $label, $url, $class = '' ) => '<!-- wp:navigation-link ' . wp_json_encode(
	array_filter(
		array(
			'label'     => $label,
			'url'       => $url,
			'kind'      => 'custom',
			'className' => $class,
		)
	),
	JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
) . ' /-->';
$nsf_utility = array(
	array( __( 'About Us', 'nsf' ), '/about-us/' ),
	array( __( 'Contact', 'nsf' ), '/contact/' ),
	array( __( 'Media Center', 'nsf' ), '/media-center/' ),
);
?>
<!-- wp:nsf/alert-banner {"text":"<?php echo esc_attr( __( 'National Sleep Foundation’s Drowsy Driving Forum  |  October 29 in Washington, DC  |', 'nsf' ) ); ?>","linkText":"<?php esc_attr_e( 'Register Now', 'nsf' ); ?>","url":"/drowsy-driving-forum/","align":"full"} /-->

<!-- wp:group {"metadata":{"name":"Nav bar"},"align":"full","className":"nsf-header","style":{"spacing":{"padding":{"top":"var:preset|spacing|30"},"margin":{"top":"0"}},"border":{"bottom":{"color":"var:preset|color|light-blue","width":"1px","style":"solid"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nsf-header has-white-background-color has-background" style="border-bottom-color:var(--wp--preset--color--light-blue);border-bottom-style:solid;border-bottom-width:1px;margin-top:0;padding-top:var(--wp--preset--spacing--30)"><!-- wp:group {"className":"nsf-header__bar","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group nsf-header__bar"><!-- wp:image {"width":"180px","sizeSlug":"full","linkDestination":"custom","className":"nsf-header__logo"} -->
<figure class="wp-block-image size-full is-resized nsf-header__logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/brand/logo-nsf.png' ) ); ?>" alt="<?php esc_attr_e( 'National Sleep Foundation home', 'nsf' ); ?>" style="width:180px"/></a></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"nsf-header__menus","layout":{"type":"flex","orientation":"vertical","justifyContent":"right"}} -->
<div class="wp-block-group nsf-header__menus"><!-- wp:group {"className":"nsf-header__utility","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group nsf-header__utility"><!-- wp:navigation {"overlayMenu":"never","className":"nsf-utility-nav","ariaLabel":"<?php esc_attr_e( 'Utility', 'nsf' ); ?>","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<?php
foreach ( $nsf_utility as $nsf_item ) {
	echo $nsf_link( $nsf_item[0], $nsf_item[1] ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON-encoded block comment.
}
?>
<!-- /wp:navigation -->

<!-- wp:search {"label":"<?php esc_attr_e( 'Search', 'nsf' ); ?>","showLabel":false,"placeholder":"<?php esc_attr_e( 'Search the site', 'nsf' ); ?>","buttonText":"<?php esc_attr_e( 'Search', 'nsf' ); ?>","buttonPosition":"button-only","buttonUseIcon":true,"isSearchFieldHidden":true,"className":"nsf-header-search"} /--></div>
<!-- /wp:group -->

<!-- wp:navigation {"overlayMenu":"mobile","className":"nsf-main-nav","ariaLabel":"<?php esc_attr_e( 'Main', 'nsf' ); ?>","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<?php
echo $nsf_link( __( 'National Programs', 'nsf' ), '/national-programs/' ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo $nsf_link( __( 'Sleep Health Resources', 'nsf' ), '/sleep-health-resources/' ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo $nsf_link( __( 'Research', 'nsf' ), '/research/' ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo $nsf_link( 'SleepTech<sup>®</sup>', '/sleeptech-network/' ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo $nsf_link( 'SleepMark<sup>®</sup>', '/sleepmark/' ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
foreach ( $nsf_utility as $nsf_item ) {
	echo $nsf_link( $nsf_item[0], $nsf_item[1], 'nsf-nav-utility-item' ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
?>
<!-- /wp:navigation --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
