<?php

namespace FbtWpBpFuncPlug;

/**
 * Class Fbt_Wp_Bp_Func_Plug_BOILERPLATE
 * @package FbtWpBpFuncPlug
 */
class Fbt_Wp_Bp_Func_Plug_Login_Form {

    /**
     * @var string
     */
    private static $self = 'FbtWpBpFuncPlug\Fbt_Wp_Bp_Func_Plug_Login_Form';

    /**
     * https://codex.wordpress.org/Customizing_the_Login_Form
     */
    public static function run() {

        add_action('login_enqueue_scripts', [self::$self, 'set_login_logo']);
        add_filter('login_headerurl', [self::$self, 'set_login_logo_url']);
        add_filter('login_headertitle', [self::$self, 'set_login_logo_url_title']);

    }

    /**
     *
     */
    public static function set_login_logo() {

        $image_path = get_stylesheet_directory_uri() . '/images/site-login-logo.png';

        echo '
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url("' . $image_path . '");
                padding-bottom: 30px;
            }
        </style>';
    }

    /**
     * @return string|void
     */
    public static function my_login_logo_url() {
        return home_url();
    }

    /**
     * @return string
     */
    public static function my_login_logo_url_title() {
        return 'Your Site Name and Info';
    }

}