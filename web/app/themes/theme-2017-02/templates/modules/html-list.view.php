<?php

$list_tag = $data['type'];
$list_elm_attributes = [];
$class_attr_value = '';

if($data['type'] !== 'ul' && $data['type'] !== 'ol') {

  if(substr($data['type'], 0, 5) === 'type-') {

    $data['type'] = substr($data['type'], 5);
    $type_pieces = explode('--', $data['type']);
    $list_tag = $type_pieces[0];

    $class_attr_value .= ' list--' . $type_pieces[1];

  }

}

if(!empty($class_attr_value)) {
  $list_elm_attributes['class'] = $class_attr_value;
}

?>

<<?php echo $list_tag; ?> <?php echo \Wordpressboilerplate\Helpers\assoc_array_to_elm_attributes_string($list_elm_attributes); ?>>

  <?php

  $items_html = '';

  foreach($data['items'] AS $item) {

    $item_content = $item['text'];

    if(!empty($item['url'])) {

      $link_elm_attrs = [];
      $link_elm_attrs['href'] = $item['url'];

      if(isset($item['open_in_new_window']) && $item['open_in_new_window']) {
        $link_elm_attrs['target'] = '_blank';
      }

      $item_content = '<a ' . \Wordpressboilerplate\Helpers\assoc_array_to_elm_attributes_string($link_elm_attrs) . '>' . $item_content . '</a>';
    }

    $items_html .= '<li>' . $item_content . '</li>';

  }

  echo $items_html;

  ?>

</<?php echo $list_tag; ?>>
