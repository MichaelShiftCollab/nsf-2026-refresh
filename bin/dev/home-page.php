<?php
/**
 * Creates or refreshes the Home page from the nsf/home pattern and sets it as
 * the static front page (build plan step 8).
 *
 * Run: php bin/wp eval-file bin/dev/home-page.php --allow-root
 * Add the argument keep to leave an existing Home page's content alone and
 * only set the front page.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

$nsf_pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( 'nsf/home' );
if ( ! $nsf_pattern ) {
	WP_CLI::error( 'The nsf/home pattern is not registered. Is the NSF theme active?' );
}

$nsf_page = get_page_by_path( 'home', OBJECT, 'page' );
$nsf_keep = in_array( 'keep', (array) ( $args ?? array() ), true );
$nsf_args = array(
	'post_type'   => 'page',
	'post_title'  => 'Home',
	'post_name'   => 'home',
	'post_status' => 'publish',
);
if ( $nsf_page ) {
	$nsf_args['ID'] = $nsf_page->ID;
}
if ( ! $nsf_page || ! $nsf_keep ) {
	$nsf_args['post_content'] = $nsf_pattern['content'];
}

$nsf_page_id = wp_insert_post( wp_slash( $nsf_args ), true );
if ( is_wp_error( $nsf_page_id ) ) {
	WP_CLI::error( $nsf_page_id );
}
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $nsf_page_id );
WP_CLI::success( "Home page {$nsf_page_id} is the front page: " . home_url( '/' ) );
