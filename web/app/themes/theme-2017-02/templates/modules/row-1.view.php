<?php

$main_elm_css_classes = 'row align-items-' . $data['vertical_alignment'];

// -----------
// Block class
// BEM!
$main_elm_css_classes .= ' ' . $data['css_block_class'] . '__row';
// Block class
// -----------

// ----------------
// Vertical padding
if(isset($data['vertical_padding']) && is_string($data['vertical_padding'])) {
  $main_elm_css_classes .= ' ' . $data['css_block_class'] . '__row--vertical-padding-' . $data['vertical_padding'];
}
// /Vertical padding
// -----------------

// -------------------
// Columns CSS classes
$columns_css_classes = $this->get_columns_css_classes();
// /Columns CSS classes
// --------------------

?>

<div class="<?php echo $main_elm_css_classes; ?>">

  <?php
  // Loop the colums in the row
  for ($column_nr = 1; $column_nr <= $data['nr_of_columns']; $column_nr++) {

    if($data['column_data'][$column_nr]['horizontal_alignment'] !== 'left') {

      $columns_css_classes[$column_nr] .= ' utility-align-' . $data['column_data'][$column_nr]['horizontal_alignment'];

    }

  ?>

    <div class="<?php echo $columns_css_classes[$column_nr]; ?>">

      <?php

      $column_content_html = '';

      // Loop modules in column
      while ($this->have_rows('column_' . $column_nr . '_modules')) {

        $this->the_row();

        $module = \fewbricks\acf\fields\flexible_content::get_sub_field_brick_instance();

        $module_css_class_value = $data['css_block_class'] . '__module';
        $module_css_class_value .= ' module-' . (\fewbricks\helpers\get_real_class_name($module));

        $column_content_html .= '<div class="' . $module_css_class_value . '">';
        $column_content_html .= $module->get_html();
        $column_content_html .= '</div>';

      } // Done looping modules in column

      echo $column_content_html;

      ?>

    </div>

  <?php
  } // Done looping columns
  ?>

</div>
