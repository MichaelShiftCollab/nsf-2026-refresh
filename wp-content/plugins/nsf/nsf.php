<?php
/**
 * Plugin Name: NSF
 * Description: Site functionality for the National Sleep Foundation: post types, taxonomies, custom blocks and site functions.
 * Version: 0.1.0
 * Requires at least: 6.6
 * Requires PHP: 8.1
 * Author: Shift Collaborative
 * License: GPL-2.0-or-later
 * Text Domain: nsf
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

define( 'NSF_VERSION', '0.1.0' );
define( 'NSF_PATH', plugin_dir_path( __FILE__ ) );
define( 'NSF_URL', plugin_dir_url( __FILE__ ) );

require_once NSF_PATH . 'includes/blocks.php';
require_once NSF_PATH . 'includes/content-model.php';
require_once NSF_PATH . 'includes/resource-file.php';
require_once NSF_PATH . 'includes/content-card.php';
require_once NSF_PATH . 'includes/resource-hub.php';

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once NSF_PATH . 'cli/class-nsf-cli.php';
}
