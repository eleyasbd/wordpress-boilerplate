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
/*$fewbricks_fg = (new fewacf\field_group('Content', '1702112147a', $fewbricks_fg_location, 10));

$fewbricks_fg->add_brick(new bricks\content_1('page_content', '1702112147b'));

$fewbricks_fg->register();*/

$fewbricks_fg = (new fewacf\field_group('Content', '1702120013a', $fewbricks_fg_location, 10));

$fewbricks_fc = (new acf_fields\flexible_content('', 'page_content', '1702120013b'));

$fewbricks_l = new fewacf\layout('Content block', 'layout_1', '1702122250a');
$fewbricks_l->add_brick((new bricks\content_block_1('1-column', '1702122250b')));
$fewbricks_fc->add_layout($fewbricks_l);

/*$fewbricks_l = new fewacf\layout('1 Column', 'layout_1', '1702120013c');
$fewbricks_l->add_brick((new bricks\content_block_1('1-column', '1702120013d'))->set_arg('nr_of_columns', 1));
$fewbricks_fc->add_layout($fewbricks_l);

$fewbricks_l = new fewacf\layout('2 Columns', 'layout_2', '1702120013r');
$fewbricks_l->add_brick((new bricks\content_block_1('2-column', '1702120013t'))->set_arg('nr_of_columns', 2));
$fewbricks_fc->add_layout($fewbricks_l);

$fewbricks_l = new fewacf\layout('3 Columns', 'layout_3', '1702121055a');
$fewbricks_l->add_brick((new bricks\content_block_1('2-column', '1702121055x'))->set_arg('nr_of_columns', 3));
$fewbricks_fc->add_layout($fewbricks_l);*/

$fewbricks_fg->add_flexible_content($fewbricks_fc);

$fewbricks_fg->register();

