<ul>

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

</ul>
