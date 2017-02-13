<?php

// loop through the rows of data
while (have_rows('page_content')) {

  the_row();

  /** @noinspection PhpUndefinedMethodInspection */
  echo \fewbricks\acf\fields\flexible_content::get_sub_field_brick_instance()->get_html([
    'is_fullwidth' => true,
  ]);

}
