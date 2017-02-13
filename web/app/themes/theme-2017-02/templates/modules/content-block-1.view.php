<?php

$main_elm_styles = 'border-bottom: solid 20px yellow;';
$main_elm_css_classes = 'content-block-1';

if(!isset($data['is_fullwidth'])) {
  $data['is_fullwidth'] = false;
}

if($data['is_fullwidth']) {

  $main_elm_css_classes .= ' content-block-1--fullwidth';

}

// Vertical padding
// ----------------
if(isset($data['vertical_padding']) && is_string($data['vertical_padding'])) {
  $main_elm_css_classes .= ' content-block-1--vertical-padding-' . $data['vertical_padding'];
}
// -----------------
// /Vertical padding

// Background
// ----------
$background_color = $this->get_field('block_background_color');
if(!empty($background_color)) {
  $main_elm_styles .= 'background-color: ' . $background_color . ';';
}

$background_image_src = wp_get_attachment_image_src(
  $this->get_field('block_background_image'),
  'full',
  false
);
if(!empty($background_image_src)) {
  $main_elm_styles .= 'background-image: url(' . $background_image_src[0] . ');';
}
// -----------
// /Background

?>

<div class="<?php echo $main_elm_css_classes; ?>"<?php echo (!empty($main_elm_styles) ? ' style="' . $main_elm_styles . '"' : ''); ?>>

  <?php
  if($data['is_fullwidth'] === true) {
  ?>
    <div class="container">
  <?php
  }
  ?>

    <?php echo $data['rows_html']; ?>

  <?php
  if($data['is_fullwidth'] === true) {
  ?>
    </div>
  <?php
  }
  ?>

</div>
