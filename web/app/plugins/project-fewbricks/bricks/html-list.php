<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class
 * @package fewbricks\bricks
 */
class html_list extends project_brick
{

  /**
   * @var string This will be the default label showing up in the editor area for the administrator.
   * It can be overridden by passing an item with the key "label" in the array that is the second argument when
   * creating a brick.
   */
  protected $label = 'List';

  /**
   * This is where all the fields for the brick will be set-
   */
  public function set_fields()
  {

    $this->add_field(new acf_fields\text('List headline', 'headline', '1509052316y'));

    $list_items_repeater = (new acf_fields\repeater('Items', 'items', '1509052323a', [
      'button_label' => 'Add item'
    ]));

    $list_items_repeater->add_sub_field(new acf_fields\text('Text', 'text', '1702131831a', [
      'required' => true,
    ]));

    $list_items_repeater->add_sub_field(new acf_fields\url('Link', 'url', '1702131838a'));

    $this->add_repeater($list_items_repeater);

  }

  private function get_view_data() {

    $view_data = [];
    $view_data['items'] = [];

    while ($this->have_rows('items')) {

      $this->the_row();

      $view_data['items'][] = [
        'text' => $this->get_field_in_repeater('items', 'text'),
        'url' => $this->get_field_in_repeater('items', 'url'),
      ];

    }

    return $view_data;

  }

  /**
   * @return string
   */
  protected function get_brick_html()
  {

    return $this->get_brick_template_html($this->get_view_data());

  }

}
