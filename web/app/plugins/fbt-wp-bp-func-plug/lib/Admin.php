<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    PluginName
 * @subpackage PluginName/admin
 */

namespace Folbert\FbtWpBpFuncPlug;

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    PluginName
 * @subpackage PluginName/admin
 * @author     Your Name <email@example.com>
 */
class Admin {

	/**
	 * The plugin's instance.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    Plugin $plugin This plugin's instance.
	 */
	private $plugin;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 *
	 * @param Plugin $plugin This plugin's instance.
	 */
	public function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 *
	 */
	public function add_custom_acf_js()
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

}
