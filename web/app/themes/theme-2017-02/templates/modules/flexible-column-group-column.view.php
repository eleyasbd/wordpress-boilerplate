<?php

$css_classes = '';

if(isset($data['column_css_classes'])) {
  $css_classes .= $data['column_css_classes'];
}

?>

<div class="<?php echo $css_classes; ?>">
  <?php
  echo $data['content'];
  ?>
</div>
