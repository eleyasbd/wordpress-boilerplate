<?php

$main_elm_attributes = [];

$main_elm_attributes['class'] = 'page-header page-header--' . $data['css_modifier_suffix'];

// ----
// Background
$main_elm_attributes['style'] = '';

if (
  !empty($data['background_image']) &&
  false !== ($background_image_url = wp_get_attachment_url($data['background_image']))
)
{

  $main_elm_attributes['style'] = 'background-image: url(\'' . $background_image_url . '\')';

}

// /Background
// -----

// ----
// Headline content
$headline_content = $data['headline_line_1'];

if (!empty($data['headline_line_2'])) {

  $headline_content .= ' <span>' . $data['headline_line_2'] . '</span>';

}

$headline_content = str_replace(
  [
    '[highlight1]',
    '[/highlight1]',
  ],
  [
    '<span style="color: yellow">',
    '</span>',
  ],
  $headline_content
);
// /Headline content
// ----

if (empty($main_elm_attributes['style'])) {
  unset($main_elm_attributes['style']);
}

?>

<div <?php echo \Wordpressboilerplate\Helpers\assoc_array_to_elm_attributes_string($main_elm_attributes); ?>>

  <?php
  if (!$data['in_container']) {
    echo '<div class="container">';
  }
  ?>


  <h1 class="page-header__headline"><?php echo $headline_content; ?></h1>

  <?php
  if (!$data['in_container']) {
    echo '</div>';
  }
  ?>

</div>
