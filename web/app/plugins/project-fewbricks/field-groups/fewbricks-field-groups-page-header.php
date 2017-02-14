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

$fewbricks_fg = (new fewacf\field_group('Page header', '1702141306a', $fewbricks_fg_location, 5));

$fewbricks_fg->add_brick( new bricks\page_header('page_header', '1702141344a'));

$fewbricks_fg->register();

