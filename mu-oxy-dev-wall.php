<?php
/**
 * Oxy Dev Wall
 *
 * @package     Oxy Dev Wall
 * @author      Max Zimmer
 * @copyright   2021 Max Zimmer
 * 
 * Plugin URL:  https://editorenhancer.com/oxy-dev-wall
 */

/**
 * Prevent direct access to the rest of the file.
 */
defined( 'ABSPATH' ) || exit( 'WP absolute path is not defined.' );


/**
 * Operations
 */
add_filter( 'option_active_plugins', 'OxyDevWall' );

function OxyDevWall( $plugins ) {

    require_once ABSPATH . 'wp-includes/pluggable.php';

    // If user isn't logged in or is logged in but not an admin
    if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {

        // Check if Oxygen is activated by checking the plugins
        $oxy_active = array_search( 'oxygen/functions.php', $plugins );

        // Oxygen is active. Unload it.
        if ( false !== $oxy_active ) {
            unset( $plugins[ $oxy_active ] );
        }
    }

    // Send new plugins list back
    return $plugins;
}