<?php

$row_css_classes = 'row align-items-' . $data['vertical_alignment'];

if (isset($data['css_block_class'])) {
  $row_css_classes .= ' ' . $data['css_block_class'] . '__row';
}

?>

<div class="<?php echo $row_css_classes; ?>" style="border-bottom: solid 10px white">

  <?php
  // Loop the colums in the row
  for ($column_nr = 1; $column_nr <= $data['nr_of_columns']; $column_nr++) {
  ?>

    <div class="<?php echo $data['column_classes'][$column_nr]; ?>">

      <?php

      $column_content_html = '';

      // Loop modules in column
      while ($this->have_rows('column_' . $column_nr . '_modules')) {

        $this->the_row();

        $column_content_html .= \fewbricks\acf\fields\flexible_content::get_sub_field_brick_instance()->get_html();

      } // Done looping modules in column

      echo $column_content_html;

      ?>

    </div>

  <?php
  } // Done looping columns
  ?>
</div>
