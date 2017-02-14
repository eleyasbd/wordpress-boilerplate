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

    // Array with classname and the corresponding file name
    // I you dont want a static function called run() to be called on the class
    // on inclusion, set a numeric index which has to be unique for the array.
    // If theres something that you don't need or want, simply comment out the line in the array
    // or remove the line entirely.
    private $files = [
        'Fbt_Wp_Bp_Func_Plug_Admin_Filters' => 'admin/class-fbt-wp-bp-func-plug-admin-filters.php',
        'Fbt_Wp_Bp_Func_Plug_Admin_Actions' => 'admin/class-fbt-wp-bp-func-plug-admin-actions.php',
        //'Fbt_Wp_Bp_Func_Plug_Login_Form' => 'admin/class-fbt-wp-bp-func-plug-login-form.php',

        'Fbt_Wp_Bp_Func_Plug_Cookie_Alert' => 'public/class-fbt-wp-bp-func-plug-cookie-alert.php',

        'Fbt_Wp_Bp_Func_Plug_Shared_Misc' => 'shared/class-fbt-wp-bp-func-plug-shared-misc.php',
        'Fbt_Wp_Bp_Func_Plug_Environment_Snitch' => 'shared/class-fbt-wp-bp-func-plug-environment-snitch.php',
        'Fbt_Wp_Bp_Func_Plug_Feeds' => 'shared/class-fbt-wp-bp-func-plug-feeds.php',
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
                $class_name::run();
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