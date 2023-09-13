<?php

require __DIR__ . '/../vendor/autoload.php';

if (!function_exists('getenv_docker')) {
	// https://github.com/docker-library/wordpress/issues/588 (WP-CLI will load this file 2x)
	function getenv_docker($env, $default) {
		if ($fileEnv = getenv($env . '_FILE')) {
			return rtrim(file_get_contents($fileEnv), "\r\n");
		}
		else if (($val = getenv($env)) !== false) {
			return $val;
		}
		else {
			return $default;
		}
	}
}

$host = $_SERVER['HTTP_HOST'] ?? getenv_docker('WORDPRESS_HOST', 'localhost:8080');

define( 'WP_HOME', 'http://' . $host );
define( 'WP_SITEURL', 'http://' . $host . '/wp' );
define( 'WP_CONTENT_URL', 'http://' . $host . '/wp-content' );
define( 'WP_CONTENT_DIR', __DIR__ . '/wp-content/' );

define( 'DB_NAME', getenv_docker('WORDPRESS_DB_NAME', 'wordpress') );
define( 'DB_USER', getenv_docker('WORDPRESS_DB_USER', 'example username') );
define( 'DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'example password') );
define( 'DB_HOST', getenv_docker('WORDPRESS_DB_HOST', 'mysql') );
define( 'DB_CHARSET', getenv_docker('WORDPRESS_DB_CHARSET', 'utf8') );
define( 'DB_COLLATE', getenv_docker('WORDPRESS_DB_COLLATE', '') );
define( 'WP_ENVIRONMENT_TYPE', getenv_docker('WP_ENVIRONMENT_TYPE', 'development') );

define( 'AUTH_KEY',         getenv_docker('WORDPRESS_AUTH_KEY',         'unique') );
define( 'SECURE_AUTH_KEY',  getenv_docker('WORDPRESS_SECURE_AUTH_KEY',  'unique') );
define( 'LOGGED_IN_KEY',    getenv_docker('WORDPRESS_LOGGED_IN_KEY',    'unique') );
define( 'NONCE_KEY',        getenv_docker('WORDPRESS_NONCE_KEY',        'unique') );
define( 'AUTH_SALT',        getenv_docker('WORDPRESS_AUTH_SALT',        'unique') );
define( 'SECURE_AUTH_SALT', getenv_docker('WORDPRESS_SECURE_AUTH_SALT', 'unique') );
define( 'LOGGED_IN_SALT',   getenv_docker('WORDPRESS_LOGGED_IN_SALT',   'unique') );
define( 'NONCE_SALT',       getenv_docker('WORDPRESS_NONCE_SALT',       'unique') );

$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wp_');

define( 'WP_DEBUG', !!getenv_docker('WORDPRESS_DEBUG', '') );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'SCRIPT_DEBUG', !!getenv_docker('WORDPRESS_DEBUG', '') );
define( 'WP_AUTO_UPDATE_CORE', false );

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/wp/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';