<?php

namespace FbtWpBpFuncPlug;

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

class Fbt_Wp_Bp_Func_Plug_Cookie_Alert
{

    public static function init()
    {

        add_action('FbtWpBpFuncPlug\CookieAlert', ['FbtWpBpFuncPlug\Fbt_Wp_Bp_Func_Plug_Cookie_Alert', 'print_alert'],
            10, 6);

    }

    /**
     * This functions sole purpose is to return the name of the cookie that
     * is set once the visitor have approved to cookies.
     * @return string
     */
    private static function get_cookies_okd_cookie_name()
    {
        return 'cookiesOkd' . md5($_SERVER['HTTP_HOST']);
    }

    /**
     * @param $text
     * @param $button_text
     * @param $block_css_class_name
     * @param $body_class_to_hide_main_elm
     * @param string $no_script_text
     * @param bool $disabled
     */
    public static function print_alert(
        $text,
        $button_text,
        $block_css_class_name,
        $body_class_to_hide_main_elm,
        $no_script_text = '',
        $disabled = false
    ) {

        if ($disabled) {
            echo '<!-- COOKIE ALERT DISABLED DUE TO DEV ENVIRONMENT -->';
            return;
        }

        $output = self::get_js1($body_class_to_hide_main_elm);
        $output .= self::get_html($block_css_class_name, $text, $button_text, $no_script_text);
        $output .= self::get_js2($block_css_class_name);

        echo $output;

    }

    /**
     * @param $body_class_to_hide_main_elm
     * @return string
     */
    private static function get_js1($body_class_to_hide_main_elm) {

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
     * @param $block_css_class_name
     * @param $text
     * @param $button_text
     * @param $no_script_text
     * @return string
     */
    private static function get_html($block_css_class_name, $text, $button_text, $no_script_text = '')
    {

        if (empty($no_script_text)) {
            $no_script_text = 'You must have JavaScript activated in your browser to be able to hide this information.';
        }

        $html = '
            <div id="' . $block_css_class_name . '-cookie-alert">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                          <div class="' . $block_css_class_name . '-cookie-alert__text-wrapper">
                            ' . $text . '
                          </div>
    
                           <noscript><p>' . $no_script_text . '</p></noscript>
    
                        </div>
    
                        <div class="col-sm-4 ' . $block_css_class_name . '-cookie-alert__button-wrapper">
                        
                          <a href="#" class="btn btn-default ' . $block_css_class_name . '-cookie-alert__button" id="' . $block_css_class_name . '-cookie-alert__ok-trigger">' . $button_text . '</a>
                          
                        </div>
                    </div>
                </div>
            </div>';

        return $html;

    }

    /**
     * @param $block_css_class_name
     * @return string
     */
    private static function get_js2($block_css_class_name)
    {

        $js = '<script>
                if(document.cookie.indexOf("' . self::get_cookies_okd_cookie_name() . '=1") === -1) {
                    var cookiesOkdCookieName = "' . self::get_cookies_okd_cookie_name() . '";
                    var cookieAlertElm = document.getElementById("' . $block_css_class_name . '-cookie-alert");
                    var exDate = new Date();
                    exDate.setDate(exDate.getDate() + 365);

                    document.getElementById("' . $block_css_class_name . '-cookie-alert__ok-trigger").onclick = function() {
                        document.cookie = cookiesOkdCookieName + "=1; expires=" + exDate.toUTCString() + "; path=/; domain=' . $_SERVER['HTTP_HOST'] . '";
                        cookieAlertElm.style.display = "none";
                        return false;
                    };
                }
            </script>';

        return $js;

    }

}

Fbt_Wp_Bp_Func_Plug_Cookie_Alert::init();