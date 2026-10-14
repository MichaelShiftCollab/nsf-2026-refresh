<?php
/**
 * Router for PHP's built-in server so pretty permalinks work locally.
 * Usage: npm run serve
 */
$path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$file = __DIR__ . '/..' . $path;

if ( '/' !== $path && file_exists( $file ) && ! is_dir( $file ) ) {
	return false;
}

chdir( dirname( __DIR__ ) );
require 'index.php';
