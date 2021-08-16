<?php

/**
 * Oxy Dev Wall
 *
 * @package           Oxy Dev Wall
 * @author            Max Zimmer
 * @copyright         2021 Max Zimmer
 *
 * @editor-enhancer
 * Plugin Name:       Oxy Dev Wall
 * Plugin URI:        https://editorenhancer.com/oxy-dev-wall
 * Description:       Develop your Oxygen website templates privately on top of an existing website.
 * Version:           1.0.0
 * Requires at least: 5.7
 * Requires PHP:      7.4
 * Author:            Max Zimmer
 * Author URI:        https://editorenhancer.com
 * Text Domain:       oxydevwall
 */

/**
 * Prevent direct access to the rest of the file.
 */
defined( 'ABSPATH' ) || exit( 'WP absolute path is not defined.' );


/**
 * Run when the plugin is activated
 */
function OxyDevWall_Activation() {

    $mu_path = WP_CONTENT_DIR . '/mu-plugins/';

    // If the mu-plugins file doesn't exist yet or isn't a directory, make it
	if ( ! file_exists( $mu_path ) || ! is_dir( $mu_path ) ) {
        mkdir( $mu_path );
    }

    // Copy the must use file from this folder into the mu-plugins directory
    copy(
        plugin_dir_path(__FILE__) . '/mu-oxy-dev-wall.php',
        $mu_path . 'oxy-dev-wall.php'
    );
}
register_activation_hook( __FILE__, 'OxyDevWall_Activation' );


/**
 * Run when the plugin is deactivated
 */
function OxyDevWall_Deactivation() {

	$mu_path = WP_CONTENT_DIR . '/mu-plugins/';

    // If the mu-plugins directory does exist and is a directory, and the oxy-dev-wall file exists as well, delete it
	if ( file_exists( $mu_path ) && is_dir( $mu_path ) && file_exists( $mu_path . 'oxy-dev-wall.php' ) ) {
        unlink( $mu_path . 'oxy-dev-wall.php' );
    }
}
register_deactivation_hook( __FILE__, 'OxyDevWall_Deactivation' );
