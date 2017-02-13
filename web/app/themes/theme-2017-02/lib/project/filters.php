<?php

namespace Wordpressboilerplate\Filters;

add_filter('fewbricks/brick/brick_layout_base_path', __NAMESPACE__ . '\\get_fewbricks_layout_base_path');
add_filter('fewbricks/brick/brick_template_base_path', __NAMESPACE__ . '\\get_fewbricks_brick_template_base_path');
add_filter('fewbricks/project_files_base_path', __NAMESPACE__ . '\\get_fewbricks_project_files_base_path');
add_filter('fewbricks/brick/brick_template_file_extension', __NAMESPACE__ . '\\get_fewbricks_template_file_extension');
add_filter('body_class', __NAMESPACE__ . '\\set_body_classes');

/**
 * @return string
 */
function get_fewbricks_brick_template_base_path() {

  return get_stylesheet_directory() . '/templates/modules/';

}

/**
 * @return string
 */
function get_fewbricks_layout_base_path() {

  return get_template_directory() . '/templates/module-layouts';

}

/**
 * @return string
 */
function get_fewbricks_project_files_base_path() {

  return WP_PLUGIN_DIR . '/project-fewbricks';

}

/**
 * @return string
 */
function get_fewbricks_template_file_extension() {

  return '.view.php';

}

/**
 * @param $body_classes
 * @return mixed
 */
function set_body_classes($body_classes) {

  if(\Wordpressboilerplate\Setup\is_fullwidth_page(get_the_ID())) {

    $body_classes[] = 'fullwidth-page';

  } else {

    $body_classes[] = 'standard-page';

  }

  return $body_classes;

}
