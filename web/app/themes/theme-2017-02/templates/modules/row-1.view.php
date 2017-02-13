<?php
$row_css_classes = 'row align-items-' . $data['vertical_alignment'];

dump($data['css_block_class']);

if (isset($data['css_block_class'])) {
  $row_css_classes .= ' ' . $data['css_block_class'] . '__row';
}
?>

<div class="<?php echo $row_css_classes; ?>">

  <?php
  for ($column_nr = 1; $column_nr <= $data['nr_of_columns']; $column_nr++) {
    ?>
    <div class="<?php echo $data['column_classes']; ?>">
      <?php echo $data['column_html'][$column_nr]; ?>
    </div>
    <?php
  }
  ?>
</div>
