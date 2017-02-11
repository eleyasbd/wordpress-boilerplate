<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class video
 * @package fewbricks\bricks
 */
class youtube extends video
{

  /**
   * @var string
   */
  protected $label = 'YouTube';

  /**
   *
   */
  public function set_fields()
  {

    $this->add_field(
      (new acf_fields\oembed('URL', 'url', '15011143u'))
        ->set_settings([
          'instructions' => 'Enter the URL of the YouTube video that you want to display.'
        ])
    );

  }

  /**
   * @return bool|mixed|null|void
   */
  protected function get_video_url()
  {

    $url = $this->get_field('url');

    if (!empty($url)) {

      preg_match('/src="(.+?)"/', $this->get_field('url'), $matches);

      if (isset($matches[1])) {

        $url_match = $matches[1];

        if (isset($matches[1])) {

          $params = [];
          $params['showinfo'] = 0;
          $params['modestbranding'] = 1;
          $params['theme'] = 'light';
          $params['rel'] = 0;
          $params['wmode'] = 'transparent';

          if (!empty($params)) {
            $url = add_query_arg($params, $url_match);
          }

        }

      }

    }

    return (empty($url) ? false : $url);

  }

}
