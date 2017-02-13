<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class row_1 extends project_brick
{

  /**
   * @var string This will be the default label showing up in the editor area for the administrator.
   * It can be overridden by passing an item with the key "label" in the array that is the second argument when
   * creating a brick.
   */
  protected $label = 'Row';

  /**
   *
   */
  public function set_fields()
  {

    $this->set_column_fields();
    $this->set_settings_fields();

  }

  /**
   *
   */
  private function set_column_fields() {

    $nr_of_columns = $this->get_arg('nr_of_columns');

    for ($column_nr = 1; $column_nr <= $nr_of_columns; $column_nr++) {

      $this->add_field(new acf_fields\tab('Column ' . $column_nr, 'column_' . $column_nr,
        '1702120008x_' . $column_nr));

      $fc = new acf_fields\flexible_content('', 'column_' . $column_nr . '_modules', '1509111554i' . $column_nr, [
        'button_label' => 'Add column content',
      ]);

      $l = new layout('', 'headline', '1603250048a' . $column_nr);
      $l->add_brick(new headline('headline', '1603250048b' . $column_nr));
      $fc->add_layout($l);

      $l = new layout('', 'text', '1603250054a' . $column_nr);
      $l->add_brick(new wysiwyg('text', '1603250054b' . $column_nr));
      $fc->add_layout($l);

      $l = new layout('', 'image', '1702112210a' . $column_nr);
      $l->add_brick(new image('image', '1702112210b' . $column_nr));
      $fc->add_layout($l);

      $l = new layout('', 'button', '1509111557u' . $column_nr);
      $l->add_brick(new button('button', '1509111556s' . $column_nr));
      $fc->add_layout($l);

      $l = new layout('', 'video', '1509111555a' . $column_nr);
      $l->add_brick(new youtube('video', '1509111556x' . $column_nr));
      $fc->add_layout($l);

      $this->add_flexible_content($fc);

    }

    // Lets store the nr of columns in a hidden field
    $this->add_field(new acf_fields\fewbricks_hidden('-', 'nr_of_columns', '1702120018a', [
      'default_value' => $nr_of_columns
    ]));

  }

  /**
   *
   */
  private function set_settings_fields() {

    $this->add_field(new acf_fields\tab('Settings', 'settings', '1702121052a'));

    $this->set_column_layout_setting_fields();

    if($this->get_arg('nr_of_columns') > 1) {

      $this->add_common_field('vertical_alignment', '1702122148a', [
        'label' => 'Row - Columns vertical alignment'
      ]);

    }

    $this->add_field(new acf_fields\select('Row - Vertical padding', 'vertical_padding', '1702130048a', [
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
  private function set_column_layout_setting_fields() {

    $choices = [
      2 => [
        'evenly' => 'Evenly distributed',
        '60_40' => '60/40',
      ],
      3 => [
        'evenly' => 'Evenly distributed'
      ],
      4 => [
        'evenly' => 'Evenly distributed'
      ],
    ];

    if(isset($choices[$this->get_arg('nr_of_columns')])) {

      $this->add_field(new acf_fields\select('Row - Column layout', 'column_layout', '1702130049a', [
        'choices' => $choices[$this->get_arg('nr_of_columns')],
        'default_value' => 'evenly',
        'allow_null' => false,
      ]));

    }

  }

  /**
   * @return string
   */
  private function get_column_css_classes()
  {

    switch ($this->get_field('nr_of_columns')) {

      case '4' :

        $column_classes = 'col-md-3';
        break;

      case '3' :

        $column_classes = 'col-md-4';
        break;

      case '2' :

        $column_classes = 'col-md-6';
        break;

      default : // Most likely 1
        $column_classes = 'col-12';
        break;

    }

    return $column_classes;

  }

  /**
   *
   */
  private function get_view_data() {

    $view_data = [];

    $view_data['nr_of_columns'] = $this->get_field('nr_of_columns');
    $view_data['column_classes'] = $this->get_column_css_classes();

    $view_data['column_html'] = [];

    for ($column_nr = 1; $column_nr <= $view_data['nr_of_columns']; $column_nr++) {

      // Start with somethinge mpty so we dont have to check for empty in the template
      $view_data['column_html'][$column_nr] = '';

      while ($this->have_rows('column_' . $column_nr . '_modules')) {

        $this->the_row();

        /** @noinspection PhpUndefinedMethodInspection */
        $view_data['column_html'][$column_nr] .= acf_fields\flexible_content::get_sub_field_brick_instance()->get_html();

      }

    }

    $view_data['vertical_alignment'] = $this->get_field('vertical_alignment');
    if(empty($view_data['vertical_alignment'])) {
      $view_data['vertical_alignment'] = 'top';
    }

    return $view_data;

  }

  /**
   * @return string
   */
  protected function get_brick_html()
  {

    $view_data = $this->get_view_data();

    $view_data['css_block_class'] = $this->get_html_args['block_css_class'];

    return $this->get_brick_template_html($view_data);

  }

}
