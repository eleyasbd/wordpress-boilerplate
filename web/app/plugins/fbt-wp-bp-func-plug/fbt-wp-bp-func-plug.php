<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       Fbt Wp Bp Func Plug
 * Plugin URI:        https://github.com/folbert/wordpress-boilerplate/tree/master/web/app/plugins
 * Description:       Functionality plugin for things that are used across almost all my WordPress installs.
 * Version:           1.0.0
 * Author:            Björn Folbert
 * Author URI:        https://folbert.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fbt-wp-bp-func-plug
 * Domain Path:       /languages
 */

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in lib/Activator.php
 */
\register_activation_hook( __FILE__, '\Folbert\FbtWpBpFuncPLug\Activator::activate' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in lib/Deactivator.php
 */
\register_deactivation_hook( __FILE__, '\Folbert\FbtWpBpFuncPlug\Deactivator::deactivate' );

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
\add_action( 'plugins_loaded', function () {
    $plugin = new \Folbert\FbtWpBpFuncPlug\Plugin();
    $plugin->run();
} );
