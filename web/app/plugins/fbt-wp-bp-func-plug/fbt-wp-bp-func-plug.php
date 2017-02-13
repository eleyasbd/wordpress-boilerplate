<?php
/*
Plugin Name: FBT WP BP Func Pplug
Plugin URI: -
Description: Functionality plugin for things that are used across almost all my WordPress installs.
Version: 1.9
Author: Björn Folber
Author URI: https://folbert.com/
This plugin is released under the GPLv2 license. The images packaged with this plugin are the property of
their respective owners, and do not, necessarily, inherit the GPLv2 license.
*/

namespace FbtWpBpFuncPlug;

class Fbt_Wp_Bp_Func_Plug {

    private $files = [
        'Fbt_Wp_Bp_Func_Plug_Admin_Filters' => 'admin/class-fbt-wp-bp-func-plug-admin-filters.php',
        'Fbt_Wp_Bp_Func_Plug_Admin_Actions' => 'admin/class-fbt-wp-bp-func-plug-admin-actions.php',
        '0' => 'public/class-fbt-wp-bp-func-plug-cookie-alert.php',
    ];

    /**
     *
     */
    public function run() {

        $base_path = plugin_dir_path(__FILE__);

        foreach($this->files AS $class_name => $file_path) {
            require_once($base_path . $file_path);

            if(intval($class_name) !== $class_name) {
                $class_name = 'FbtWpBpFuncPlug\\' . $class_name;
                (new $class_name())->run();
            }
        }

    }

}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_fbt_wp_bp_func_plug() {

    $plugin = new Fbt_Wp_Bp_Func_Plug();
    $plugin->run();

}
run_fbt_wp_bp_func_plug();