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

    $viewData = [];
    $viewData['url'] = $this->get_video_url();

    return $this->get_brick_template_html($viewData);

  }

}
