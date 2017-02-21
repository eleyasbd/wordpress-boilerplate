<?php

// The wrapping column div with bootstrap css classes is set in flexible-column-group.view.php
// This is due to performance reasons to avoid having to loop through column layouts multiple times,

$main_div_attributes = [];

$main_div_attributes['class'] = [
  'flexible-column-group-column__inner',
  'text-' . $data['horizontal_alignment_content'],
];

?>

<?php
// Wrapping div to be able to apply styles on content
echo '<div ' . Folbert\FbtWpBpFuncPlug\Shared\Helper::assoc_array_to_elm_attributes_string($main_div_attributes) . '>';
echo $data['content'];
echo '</div>';
