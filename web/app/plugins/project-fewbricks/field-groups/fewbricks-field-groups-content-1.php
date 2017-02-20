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

$fewbricks_fg = (new fewacf\field_group('Content', '1702120013a', $fewbricks_fg_location, 10));

$fewbricks_fc = (new acf_fields\flexible_content('', 'page_content', '1702120013b'));

$fewbricks_l = new fewacf\layout('Content block', 'layout_1', '1702122250a');
$fewbricks_l->add_brick((new bricks\content_block_1('1-column', '1702122250b')));
$fewbricks_l->set_setting('display', 'block');
$fewbricks_fc->add_layout($fewbricks_l);

$fewbricks_fg->add_flexible_content($fewbricks_fc);

$fewbricks_fg->register();

