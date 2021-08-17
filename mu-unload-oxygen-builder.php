<?php

/**
 * Unload Oxygen Builder
 *
 * @wordpress-plugin
 * Plugin URI:          https://github.com/oxyrealm/unload-oxygen-builder
 * Version:             1.1.0
 * Requires at least:   5.7
 * Requires PHP:        7.4
 * Author:              Max Zimmer, dPlugins.com
 * Text Domain:         unload-oxygen-builder
 *
 * @package             Unload Oxygen Builder
 * @author              Max Zimmer, oxyrealm <hello@oxyrealm.com>
 * @copyright           2021 Max Zimmer
 * @version             1.1.17
 * @since               1.0.0
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'option_active_plugins', function($active_plugins) {
    require_once ABSPATH . 'wp-includes/pluggable.php';
    require_once WP_PLUGIN_DIR . '/unload-oxygen-builder/Oxygen.php';

    if ( ! Oxyrealm\Aether\Utils\Oxygen::can() ) {
        $oxygen = 'oxygen/functions.php';
        $oxygen_index = array_search( $oxygen, $active_plugins );

        if ( false !== $oxygen_index ) {
            array_splice( $active_plugins, $oxygen_index, 1 );
        }
    }

    return $active_plugins;
} );