<?php

namespace Folbert\FbtWpBpFuncPlug\Admin;

/**
 * Class Fbt_Wp_Bp_Func_Plug_BOILERPLATE
 * @package FbtWpBpFuncPlug
 */
class LoginForm {

	/**
	 * https://codex.wordpress.org/Customizing_the_Login_Form
	 */
	public function define_hooks() {

		add_action('login_enqueue_scripts', [$this, 'set_login_logo']);
		add_filter('login_headerurl', [$this, 'set_login_logo_url']);
		add_filter('login_headertitle', [$this, 'set_login_logo_url_title']);

	}

	/**
	 *
	 */
	public function set_login_logo() {

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
	public function my_login_logo_url() {
		return home_url();
	}

	/**
	 * @return string
	 */
	public function my_login_logo_url_title() {
		return 'Your Site Name and Info';
	}

	public function remove_admin_features() {

		// Remove editor support tp avoid flashing content after ACF has loaded
		remove_post_type_support('page', 'editor');

	}

}
