<?php

namespace Wordpressboilerplate\Actions;

add_action('init', __NAMESPACE__ . '\\remove_admin_features', 100);

/**
 *
 */
function remove_admin_features() {

  // Remove editor support tp avoid flashing content after ACF has loaded
  remove_post_type_support('page', 'editor');

}
