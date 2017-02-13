<?php

namespace FbtWpBpFuncPlug;

class Fbt_Wp_Bp_Func_Plug_Admin_Actions {

    public function run() {

        add_action('admin_footer', [$this, 'add_acf_utilities']);

    }

    /**
     *
     */
    public function add_acf_utilities() {

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


}