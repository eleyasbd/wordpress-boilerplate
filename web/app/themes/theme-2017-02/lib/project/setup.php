<?php

namespace Wordpressboilerplate\Setup;

/**
 * @param $post_id
 * @return bool
 */
function is_fullwidth_page($post_id) {

  // Place logic for displaying the page as fullwidth or not here
  return is_page($post_id);

}
