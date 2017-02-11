<?php

/**
 * Example file on how to build field groups.
 * "Namespacing" by prefixing variable names with "fewbricks" is optional
 * but is recommended to avoid the, clashing with other data in WordPress.
 */

use fewbricks\bricks AS bricks;
use fewbricks\acf AS fewacf;
use fewbricks\acf\fields AS acf_fields;

/**
 * Define where the field group should be used
 */
$fewbricks_fg_location = [
  [
    [
      'param' => 'post_type',
      'operator' => '==',
      'value' => 'page',
    ],
  ]
];

/**
 * Lets  create a bunch of field groups.
 * The reason for increasing the order-argument by then is that it makes it easier to add new field groups
 * in between existing ones later on.
 * Make sure that you check out the bricks that we create instances of here to get a sense of what is going on.
 */

/**
 * Jumbotron
 * Showing how to use a simple brick.
 */
$fewbricks_fg = (new fewacf\field_group('Content', '1702112147a', $fewbricks_fg_location, 10));

$fewbricks_fg->add_brick(new bricks\content_1('page_content', '1702112147b'));

$fewbricks_fg->register();
