<?php
/**
 * Local development config. Not deployed: WP Engine supplies its own wp-config.php.
 * Uses SQLite through the sqlite-database-integration drop-in (wp-content/db.php).
 */
define( 'DB_NAME', 'nsf' );
define( 'DB_USER', '' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', '' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );
define( 'DB_DIR', __DIR__ . '/.local/database/' );
define( 'DB_FILE', 'nsf.sqlite' );

if ( file_exists( __DIR__ . '/wp-config-local.php' ) ) {
	require __DIR__ . '/wp-config-local.php';
}

defined( 'AUTH_KEY' ) || define( 'AUTH_KEY', 'local-dev-only' );
defined( 'SECURE_AUTH_KEY' ) || define( 'SECURE_AUTH_KEY', 'local-dev-only' );
defined( 'LOGGED_IN_KEY' ) || define( 'LOGGED_IN_KEY', 'local-dev-only' );
defined( 'NONCE_KEY' ) || define( 'NONCE_KEY', 'local-dev-only' );
defined( 'AUTH_SALT' ) || define( 'AUTH_SALT', 'local-dev-only' );
defined( 'SECURE_AUTH_SALT' ) || define( 'SECURE_AUTH_SALT', 'local-dev-only' );
defined( 'LOGGED_IN_SALT' ) || define( 'LOGGED_IN_SALT', 'local-dev-only' );
defined( 'NONCE_SALT' ) || define( 'NONCE_SALT', 'local-dev-only' );

$table_prefix = 'wp_';

defined( 'WP_DEBUG' ) || define( 'WP_DEBUG', true );
defined( 'WP_DEBUG_LOG' ) || define( 'WP_DEBUG_LOG', true );
defined( 'WP_DEBUG_DISPLAY' ) || define( 'WP_DEBUG_DISPLAY', false );
defined( 'WP_ENVIRONMENT_TYPE' ) || define( 'WP_ENVIRONMENT_TYPE', 'local' );
defined( 'WP_DEVELOPMENT_MODE' ) || define( 'WP_DEVELOPMENT_MODE', 'all' ); // No theme.json or pattern caching locally.

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
