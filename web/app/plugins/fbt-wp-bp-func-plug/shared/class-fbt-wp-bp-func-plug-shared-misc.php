<?php

namespace FbtWpBpFuncPlug;

/**
 * Class Fbt_Wp_Bp_Func_Plug_Shared_Misc
 * @package FbtWpBpFuncPlug
 */
class Fbt_Wp_Bp_Func_Plug_Shared_Misc
{

    /**
     * @var string
     */
    private static $self = 'FbtWpBpFuncPlug\Fbt_Wp_Bp_Func_Plug_Shared_Misc';

    /**
     *
     */
    public static function run()
    {

        // http://wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2
        add_action('init', [self::$self, 'disable_wp_emojicons']);

        // http://www.wpbeginner.com/wp-tutorials/the-right-way-to-remove-wordpress-version-number/
        add_filter('the_generator', [self::$self, 'remove_wp_version']);


    }

    /**
     * @return string
     */
    public static function remove_wp_version() {
        return '';
    }

    /**
     *
     */
    public static function disable_wp_emojicons()
    {

        // all actions related to emojis
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        add_filter('emoji_svg_url', '__return_false');

        // filter to remove TinyMCE emojis
        add_filter('tiny_mce_plugins', [self::$self, 'disable_emojicons_tinymce']);

    }

    /**
     * @param $plugins
     * @return array
     */
    public static function disable_emojicons_tinymce($plugins)
    {
        if (is_array($plugins)) {
            return array_diff($plugins, array('wpemoji'));
        } else {
            return array();
        }
    }

}