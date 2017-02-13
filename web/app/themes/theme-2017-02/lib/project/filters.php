<?php

namespace Wordpressboilerplate\Filters;

add_filter('fewbricks/brick/brick_layout_base_path', __NAMESPACE__ . '\\set_fewbricks_layout_base_path');
add_filter('body_class', __NAMESPACE__ . '\\set_body_classes');

/**
 * @return string
 */
function set_fewbricks_layout_base_path() {

  return get_template_directory() . '/templates/module-layouts/';

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
