<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class content_block_1 extends project_brick
{

  /**
   * @var string This will be the default label showing up in the editor area for the administrator.
   * It can be overridden by passing an item with the key "label" in the array that is the second argument when
   * creating a brick.
   */
  protected $label = 'Content';

  /**
   *
   */
  public function set_fields()
  {

    $this->set_settings_fields();
    $this->set_column_fields();

  }

  /**
   *
   */
  private function set_settings_fields()
  {

    $this->add_field(new acf_fields\tab('Settings', 'settings', '1702121052a'));

    $this->add_field(new acf_fields\image('Content block - Background image', 'block_background_image', '1702121053a'));

    $this->add_common_field('background_color', '1702121545a', [
      'name' => 'block_background_color',
      'label' => 'Content block - background color'
    ]);

    $this->add_field(new acf_fields\select('Content block - Vertical padding', 'vertical_padding', '1702122201a', [
      'choices' => [
        'standard' => 'Standard',
        'medium' => 'Medium',
        'small' => 'Small',
        'none' => 'None'
      ],
      'default_value' => 'standard',
      'allow_null' => false,
    ]));

  }

  /**
   *
   */
  private function set_column_fields()
  {

    $fc = new acf_fields\flexible_content('', 'content', '1702122301a', [
      'button_label' => 'Add row'
    ]);

    $layout = new layout('1 column', 'layout_1', '1702122301b');
    $layout->add_brick((new row_1('1-column', '1702122301c'))->set_arg('nr_of_columns', 1));
    $fc->add_layout($layout);

    $layout = new layout('2 columns', 'layout_2', '1702122301x');
    $layout->add_brick((new row_1('2-column', '1702122301y'))->set_arg('nr_of_columns', 2));
    $fc->add_layout($layout);

    $layout = new layout('3 columns', 'layout_3', '1702122319a');
    $layout->add_brick((new row_1('3-column', '1702122319b'))->set_arg('nr_of_columns', 3));
    $fc->add_layout($layout);

    $layout = new layout('4 columns', 'layout_4', '1702122319x');
    $layout->add_brick((new row_1('4-column', '1702122319y'))->set_arg('nr_of_columns', 4));
    $fc->add_layout($layout);

    $this->add_flexible_content($fc);

  }

  /**
   *
   */
  private function get_view_data() {

    $view_data = [];

    $view_data['vertical_padding'] = $this->get_field('vertical_padding');

    $view_data['is_fullwidth'] = (
      isset($this->get_html_args['is_fullwidth']) &&
      $this->get_html_args['is_fullwidth'] === true
    );

    $view_data['rows_html'] = '';

    while($this->have_rows('content')) {

      $this->the_row();

      $view_data['rows_html'] .= acf_fields\flexible_content::get_sub_field_brick_instance()->get_html([
        'block_css_class' => 'content-block-1'
      ]);

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
