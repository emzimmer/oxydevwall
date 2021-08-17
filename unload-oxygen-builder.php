<?php

/**
 * Unload Oxygen Builder
 *
 * @wordpress-plugin
 * Plugin Name:         Unload Oxygen Builder
 * Plugin URI:          https://github.com/oxyrealm/unload-oxygen-builder
 * Description:         Develop your Oxygen website templates privately on top of an existing website.
 * Version:             1.1.0
 * Requires at least:   5.7
 * Requires PHP:        7.4
 * Author:              Max Zimmer, dPlugins.com
 * Text Domain:         unload-oxygen-builder
 *
 * @package             Unload Oxygen Builder
 * @author              Max Zimmer, oxyrealm <hello@oxyrealm.com>
 * @copyright           2021 Max Zimmer, oxyrealm
 * @version             1.1.17
 * @since               1.0.0
 */

defined( 'ABSPATH' ) || exit;

define( 'OXY_DEV_WALL_MU_FILENAME', 'mu-unload-oxygen-builder.php' );

register_activation_hook( __FILE__, function() {
	if ( ! file_exists( WPMU_PLUGIN_DIR ) || ! is_dir( WPMU_PLUGIN_DIR ) ) {
        mkdir( WPMU_PLUGIN_DIR );
    }

    if ( file_exists( WPMU_PLUGIN_DIR . '/' . OXY_DEV_WALL_MU_FILENAME ) ) {
        unlink( WPMU_PLUGIN_DIR . '/' . OXY_DEV_WALL_MU_FILENAME );
    }

    copy(
        plugin_dir_path(__FILE__) . '/'. OXY_DEV_WALL_MU_FILENAME,
        WPMU_PLUGIN_DIR . '/' . OXY_DEV_WALL_MU_FILENAME
    );
} );

register_deactivation_hook( __FILE__, function() {
	if ( file_exists( WPMU_PLUGIN_DIR . '/' . OXY_DEV_WALL_MU_FILENAME ) ) {
        unlink( WPMU_PLUGIN_DIR . '/' . OXY_DEV_WALL_MU_FILENAME );
    }
} );
