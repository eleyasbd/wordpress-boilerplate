<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class button extends project_brick
{

  /**
   * @var string This will be the default label showing up in the editor area for the administrator.
   * It can be overridden by passing an item with the key "label" in the array that is the second argument when
   * creating a brick.
   */
  protected $label = 'Button';

  /**
   * This is where all the fields for the brick will be set.
   */
  public function set_fields()
  {

    $this->add_field(new acf_fields\select('Type', 'type', '1509032104a', [
        'choices' => [
          'internal' => 'Internal',
          'external' => 'External',
          'email' => 'E-mail',
          'download' => 'Download',
        ],
        'allow_null' => false,
        'default_value' => 'internal',
        'required' => true,
      ]
    ));

    $this->add_field(new acf_fields\text('Text', 'text', '1509072239o', [
      'required' => true,
    ]));

    $this->add_field(new acf_fields\post_object('Item', 'internal_item', '1509032109u', [
      'conditional_logic' => [
        [
          [
            'field' => '1509032104a',
            'operator' => '==',
            'value' => 'internal',
          ],
        ]
      ]
    ]));

    $this->add_field(
      (new acf_fields\url('URL', 'external_url', '1509032109r'))->set_setting('conditional_logic',
        [
          [
            [
              'field' => '1509032104a',
              'operator' => '==',
              'value' => 'external',
            ],
          ]
        ]
      ));

    $this->add_field((new acf_fields\email('E-mail', 'email', '1509032109s'))->set_setting('conditional_logic',
      [
        [
          [
            'field' => '1509032104a',
            'operator' => '==',
            'value' => 'email',
          ],
        ]
      ]
    ));

    $this->add_field((new acf_fields\file('File', 'file', '1509032109t'))->set_setting('conditional_logic',
      [
        [
          [
            'field' => '1509032104a',
            'operator' => '==',
            'value' => 'download',
          ],
        ]
      ]
    ));

    $this->add_field((new acf_fields\true_false('Open link in new window/tab', 'target_blank',
      '1509111327a'))->set_setting('conditional_logic',
      [
        [
          [
            'field' => '1509032104a',
            'operator' => '!=',
            'value' => 'email',
          ],
        ]
      ]
    ));

  }

  /**
   * @return string|void
   */
  public function get_brick_html()
  {

    return $this->get_brick_template_html($this->get_view_data());

  }

  /**
   *
   */
  private function get_view_data() {

    $button_type = $this->get_field('type');

    switch ($button_type) {

      case 'internal' :

        $view_data = $this->get_internal_type_view_data();
        break;

      case 'external' :

        $view_data = $this->get_external_type_view_data();
        break;

      case 'email' :

        $view_data = $this->get_email_type_view_data();
        break;

      case 'download' :

        $view_data = $this->get_download_type_view_data();
        break;

    }

    $view_data['type'] = $button_type;
    $view_data['open_in_new_window'] = $this->get_field('target_blank');
    $view_data['text'] = $this->get_field('text');

    return $view_data;

  }

  /**
   * @return string
   */
  private function get_internal_type_view_data()
  {

    $view_data = [];

    $view_data['href'] = '';

    $object_id = $this->get_field('internal_item');

    if (!empty($object_id)) {

      $view_data['href'] = get_the_permalink($object_id);

    }

    return $view_data;

  }

  /**
   * @return string
   */
  private function get_external_type_view_data()
  {

    $view_data = [];

    $view_data['href'] = $this->get_field('external_url');

    return $view_data;

  }

  /**
   * @return string
   */
  private function get_email_type_view_data()
  {

    $view_data = [];

    $view_data['href'] = 'mailto:' . $this->get_field('email');

    return $view_data;

  }

  /**
   * @return string
   */
  private function get_download_type_view_data()
  {

    $view_data = [];

    $view_data['href'] = '';

    $file_id = $this->get_field('file');

    if (!empty($file_id)) {

      $view_data['href'] = wp_get_attachment_url($file_id);

    }

    return $view_data;

  }

}
