<?php

namespace Folbert\FbtWpBpFuncPlug\Shared;

class Fewbricks {

	/**
	 *
	 */
	public function define_hooks() {

		add_filter('fewbricks/brick/brick_layout_base_path', [$this, 'get_fewbricks_layout_base_path']);
		add_filter('fewbricks/brick/brick_template_base_path', [$this, 'get_fewbricks_brick_template_base_path']);
		add_filter('fewbricks/project_files_base_path', [$this, 'get_fewbricks_project_files_base_path']);
		add_filter('fewbricks/brick/brick_template_file_extension', [$this, 'get_fewbricks_template_file_extension']);
		add_action('admin_notices', [$this, 'fewbricks_edit_field_group_info']);

	}

	/**
	 * @return string
	 */
	public function get_fewbricks_brick_template_base_path() {

		return get_stylesheet_directory() . '/templates/modules/';

	}

	/**
	 * @return string
	 */
	public function get_fewbricks_layout_base_path() {

		return get_template_directory() . '/templates/module-layouts';

	}

	/**
	 * @return string
	 */
	public function get_fewbricks_project_files_base_path() {

		return WP_PLUGIN_DIR . '/project-fewbricks';

	}

	/**
	 * @return string
	 */
	public function get_fewbricks_template_file_extension() {

		return '.view.php';

	}

	/**
	 *
	 */
	public function fewbricks_edit_field_group_info()
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
