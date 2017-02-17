<?php

namespace Folbert\FbtWpBpFuncPlug\Frontend;

/**
 * The reason for using a lot of JS here is that we can not use PHP since we will most likely use a
 * caching plugin which will risk caching the page to either not display the alert at all or always
 * display it.
 * I am aware that the code adds some small javascript and css snippets and that the HTML for the alert
 * is loaded every time. I considered using ajax to inject the alert but that would make the alert not show
 * up for visitors without JS activated. My solution will always display the alert to people with JS off and
 * since the cookie is set using JS, there will be no way for the visitor to get rid of the alert.
 * I am using vanilla JS for everything JS-related to make sure that the code works even if jQuery
 * is not loaded or used at all.
 */

class CookieAlert
{

	/**
	 *
	 */
	public function define_hooks()
	{

		add_action('FbtWpBpFuncPlug\CookieAlert\Get', [$this, 'print_alert'], 10, 4);

	}

	/**
	 * This functions sole purpose is to return the name of the cookie that
	 * is set once the visitor have approved to cookies.
	 * @return string
	 */
	private function get_cookies_okd_cookie_name()
	{
		return 'cookiesOkd' . md5($_SERVER['HTTP_HOST']);
	}

	/**
	 * @param $html
	 * @param $main_elm_id
	 * @param $hide_trigger_id
	 * @param $body_class_to_hide_main_elm
	 * @internal param $block_css_class_name
	 */
	public function print_alert($html, $main_elm_id, $hide_trigger_id, $body_class_to_hide_main_elm) {

		$output = $this->get_js1($body_class_to_hide_main_elm);
		$output .= $html;
		$output .= $this->get_js2($main_elm_id, $hide_trigger_id);

		echo $output;

	}

	/**
	 * @param $body_class_to_hide_main_elm
	 * @return string
	 */
	private function get_js1($body_class_to_hide_main_elm) {

		// Since this JS will run before the html element is rendered, we will make sure that the
		// element will be hidden from the start if cookies have been accespted
		$js = '
        <script>
            if(document.cookie.indexOf("' . self::get_cookies_okd_cookie_name() . '=1") !== -1) {
                document.getElementsByTagName("body")[0].className += " ' . $body_class_to_hide_main_elm . '";
            }
        </script>';

		return $js;

	}

	/**
	 * @param $main_elm_id
	 * @param $hide_trigger_id
	 * @return string
	 */
	private function get_js2($main_elm_id, $hide_trigger_id)
	{

		$js = '<script>
                if(document.cookie.indexOf("' . self::get_cookies_okd_cookie_name() . '=1") === -1) {
                    var cookiesOkdCookieName = "' . self::get_cookies_okd_cookie_name() . '";
                    var cookieAlertElm = document.getElementById("' . $main_elm_id . '");
                    var exDate = new Date();
                    exDate.setDate(exDate.getDate() + 365);

                    document.getElementById("' . $hide_trigger_id . '").onclick = function() {
                        document.cookie = cookiesOkdCookieName + "=1; expires=" + exDate.toUTCString() + "; path=/; domain=' . $_SERVER['HTTP_HOST'] . '";
                        cookieAlertElm.style.display = "none";
                        return false;
                    };
                }
            </script>';

		return $js;

	}

}
