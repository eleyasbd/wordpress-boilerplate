<?php

namespace Project;

class Layout {

  /**
   *
   */
  public function define_hooks() {

    add_filter('body_class', [$this, 'set_body_classes']);

  }

  /**
   * @param $post_id
   * @return bool
   */
  public static function is_fullwidth_page($post_id) {

    // Place logic for displaying the page as fullwidth or not here
    return is_page($post_id);

  }

  /**
   * @param $body_classes
   * @return mixed
   */
  public function set_body_classes($body_classes) {

    if(self::is_fullwidth_page(get_the_ID())) {

      $body_classes[] = 'fullwidth-page';

    } else {

      $body_classes[] = 'standard-page';

    }

    return $body_classes;

  }

}
