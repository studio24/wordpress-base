<?php
/**
 * Studio 24 Base WordPress plugin
 *
 * Used to group together some base functionality we use across all WordPress sites
 */


/**
 * Remove Site Health tests that are not required for our setup
 * @see https://developer.wordpress.org/reference/hooks/site_status_tests/
 */
add_filter( 'site_status_tests', function($tests){
    unset( $tests['async']['background_updates'] );
    return $tests;
} );
