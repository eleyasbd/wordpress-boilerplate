<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class video
 * @package fewbricks\bricks
 */
class video extends project_brick
{

  /**
   * @var string
   */
  protected $label = 'Video';

  /**
   * @return string
   */
  protected function get_brick_html()
  {

    $view_data = [];
    $view_data['url'] = $this->get_video_url();

    return $this->get_brick_template_html($view_data);

  }

}
