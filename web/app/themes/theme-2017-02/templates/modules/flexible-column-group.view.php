<div class="container flexible-column-group">
  <div class="row flexible-column-group__row align-items-<?php echo $data['vertical_alignment'] ?>">

    <?php

    foreach($data['rows'] AS $row_index => $row) {

      /**
       * @var  $layout_index
       * @var \fewbricks\acf\layout $layout
       */
      foreach($row AS $layout_index => $layout) {

    ?>

        <div class="col-md-<?php echo $layout->get_data_item('column_width'); ?> flexible-column-group__column">

        <?php
          echo $layout->get_data_item('content_html');
        ?>

        </div>

    <?php

      }

      // End a row
      echo '<div class="w-100"></div>';

    }

    ?>


  </div>
</div>
