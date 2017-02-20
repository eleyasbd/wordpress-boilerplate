<div class="container">
  <div class="row">

    <?php

    foreach($data['rows'] AS $row_index => $row) {

      foreach($row AS $layout_index => $layout) {

        /*echo $layout->get_html([
          'column_css_classes' => 'col-md-6',
        ]);*/

      }

      // End a row
      echo '<div class="w-100"></div>';

    }

    ?>


  </div>
</div>
