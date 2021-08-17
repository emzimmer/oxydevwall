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

    /**
     * Modify your privileges here
     */
    $privileges = array(
        'manage_options'
    );
    /**
     * Stop editing
     */

    // Set flag for privileged user
    $user_is_privileged = false;

    // If user is logged in..
    if ( is_user_logged_in() ) {

        // .. and adheres to one or ore special priviliges
        foreach( $privileges as $privilege ) {
            if ( current_user_can( $privilege ) ) {

                // Set truthy flag
                $user_is_privileged = true;
                break; // No need to keep checking
            }
        }
    }

    // If user isn't logged in or is logged in but not privileged
    if ( ! $user_is_privileged ) {

        // Check if Oxygen is activated by checking the plugins list
        $oxy_active = array_search( 'oxygen/functions.php', $plugins );

        // Oxygen is active. Unload it.
        if ( false !== $oxy_active ) {
            unset( $plugins[ $oxy_active ] );
        }
    }

    // Send new plugins list back
    return $plugins;
}
