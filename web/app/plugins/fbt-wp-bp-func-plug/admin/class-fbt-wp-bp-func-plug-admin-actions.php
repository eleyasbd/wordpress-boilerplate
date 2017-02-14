<?php

namespace FbtWpBpFuncPlug;

/**
 * Class Fbt_Wp_Bp_Func_Plug_Admin_Actions
 * @package FbtWpBpFuncPlug
 */
class Fbt_Wp_Bp_Func_Plug_Admin_Actions
{

    /**
     * @var string
     */
    private static $self = 'FbtWpBpFuncPlug\Fbt_Wp_Bp_Func_Plug_Admin_Actions';

    /**
     *
     */
    public static function run()
    {

        add_action('admin_footer', [self::$self, 'add_custom_acf_js']);
        add_action('admin_notices', [self::$self, 'fewbricks_edit_field_group_info']);

    }

    /**
     *
     */
    public static function add_custom_acf_js()
    {

        echo '
        <script>
            jQuery(".acf-fc-layout-controlls [data-event=\'remove-layout\']").on("click", function(event) {
                
                var layoutName = jQuery(this).parents(".layout:first").find(".acf-fc-layout-handle:first").text();
                
                if(!confirm("Are you sure you want to delete \"" + layoutName + "\"?")) {
                    event.stopPropagation();
                    event.preventDefault();
                }
                
            });
        </script>';

    }

    /**
     *
     */
    public static function fewbricks_edit_field_group_info()
    {

        if(get_current_screen()->post_type === 'acf-field-group') {

            $message_html = '
                <div class="notice notice-info">
                    <p>If you are looking for field groups that you know should be here, please note that we are using <a href="https://github.com/folbert/fewbricks" target="_blank">Fewbricks</a> to create ACF-fields.</p>
                </div>';

            echo $message_html;

        }

    }


}