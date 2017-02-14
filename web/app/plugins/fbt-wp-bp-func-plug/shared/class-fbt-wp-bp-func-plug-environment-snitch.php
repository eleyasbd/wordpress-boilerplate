<?php

namespace FbtWpBpFuncPlug;

/**
 * Class Fbt_Wp_Bp_Func_Plug_Shared_Misc
 * @package FbtWpBpFuncPlug
 */
class Fbt_Wp_Bp_Func_Plug_Environment_Snitch
{

    /**
     * @var string
     */
    private static $self = 'FbtWpBpFuncPlug\Fbt_Wp_Bp_Func_Plug_Environment_Snitch';

    /**
     *
     */
    public static function run()
    {

        if (defined('WP_ENV') && WP_ENV !== 'production') {

            add_action('admin_head', [self::$self, 'css']);
            add_action('wp_head', [self::$self, 'css']);
            add_action('admin_bar_menu', [self::$self, 'admin_bar_item'], 999);

        }

    }

    /**
     *
     */
    public static function css()
    {

        if (is_user_logged_in()) {

            $style = '';

            $colors = [
                'development' => '#c80c0c',
                'staging' => '#e6830a',
            ];

            if (defined('WP_ENV') &&
                isset($colors[WP_ENV])
            ) {

                $style .= '
                    #wpadminbar {
                        background: ' . $colors[WP_ENV] . ';
                    }
                    #wpadminbar #wp-admin-bar-' . self::get_id_string() . ' span {
                        color: ' . $colors[WP_ENV] . ';
                        border-color: ' . $colors[WP_ENV] . ';
                    }';

            }

            // Hide the link in the item telling us what env. we are in.
            // Not very nice precious. Not very nice at all. But since we are logged in and not
            // in production, it seems like an ok solution. Also add some other styles.
            // Double IDs to increase specificity.
            $style .= '
                #wpadminbar #wp-admin-bar-' . self::get_id_string() . ' a {
                    display: none;
                }
                #wpadminbar #wp-admin-bar-' . self::get_id_string() . ' span {
                    display: block;
                    padding: 0 8px 0 7px;
                    background: #fff;
                    border: solid 1px;
                    height: 30px;
                }';

            echo '<style>' . $style . '</style>';

        }

    }

    /**
     * @param $wp_admin_bar
     */
    public static function admin_bar_item($wp_admin_bar)
    {

        if (defined('WP_ENV')) {

            $wp_admin_bar->add_node([
                'id' => self::get_id_string(),
                'title' => WP_ENV,
                'href' => '#',
                'meta' => [
                    'html' => '<span>' . ucfirst(WP_ENV) . '</span>'
                ]
            ]);

        }

    }

    /**
     * @return mixed
     */
    private static function get_id_string() {

        return str_replace('\\', '-', strtolower(__NAMESPACE__));

    }


}
