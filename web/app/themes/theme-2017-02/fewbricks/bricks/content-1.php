<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class content_1 extends project_brick
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

    $fc = new acf_fields\flexible_content('', 'modules', '1509111554i');

    $l = new layout('', 'headline', '1603250048a');
    $l->add_brick(new headline('headline', '1603250048b'));
    $fc->add_layout($l);

    $l = new layout('', 'text', '1603250054a');
    $l->add_brick(new wysiwyg('text', '1603250054b'));
    $fc->add_layout($l);

    $l = new layout('', 'image', '1702112210a');
    $l->add_brick(new image('image', '1702112210b'));
    $fc->add_layout($l);

    $l = new layout('', 'button', '1509111557u');
    $l->add_brick(new button('button', '1509111556s'));
    $fc->add_layout($l);

    $l = new layout('', 'video', '1509111555a');
    $l->add_brick(new youtube('video', '1509111556x'));
    $fc->add_layout($l);

    $this->add_flexible_content($fc);

  }

  /**
   * @return string
   */
  protected function get_brick_html()
  {

    $html = '';

    while ($this->have_rows('modules')) {

      $this->the_row();

      /** @noinspection PhpUndefinedMethodInspection */
      $html .= acf_fields\flexible_content::get_sub_field_brick_instance()->get_html();

    }

    return $html;

  }

}
