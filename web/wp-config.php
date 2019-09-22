<?php
/**
 * WordPress config
 */

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/wordpress/' );
}

if ( ! defined( 'WP_CONTENT_DIR' ) ) {
    define( 'WP_CONTENT_DIR', __DIR__ . '/content' );
}

/** Load the Studio 24 WordPress Multi-Environment Config. */
require_once(dirname(__FILE__) . '/../config/wp-config.load.php');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
