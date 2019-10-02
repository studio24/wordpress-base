<?php
/*
Plugin Name: Studio 24 Base WordPress plugin
Description: Used to set secure defaults on WordPress
Author: Studio 24 Ltd
Version: 1.0.0
Author URI: https://www.studio24.net/
*/

/**
 * Remove Site Health tests that are not required for our setup
 * @see https://developer.wordpress.org/reference/hooks/site_status_tests/
 */
add_filter( 'site_status_tests', function($tests){
    unset( $tests['async']['background_updates'] );
    return $tests;
} );

/**
 * Enforce user login to access restricted API endpoints
 * @see https://developer.wordpress.org/reference/hooks/rest_authentication_errors/
 */
add_filter( 'rest_authentication_errors', function($access) {

    // Array of restricted API endpoints (user must be logged in to access)
    $restrictedApiEndpoints = [
        'wp-json/wp/v2/users',
    ];

    foreach ($restrictedApiEndpoints as $endpoint) {
        $preg = preg_quote($endpoint, '!');
        if (preg_match('!' . $preg . '!', $_SERVER['REQUEST_URI']) && !is_user_logged_in()) {
            return new WP_Error('rest_access_unauthorized', 'You must be an authenticated user to access this REST API endpoint', ['status' => 401]);
        }
    }

    return $access;
});
