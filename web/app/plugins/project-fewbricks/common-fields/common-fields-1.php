<?php

/**
 * If you have fields that you are going to use in multiple places, you can define them like this and them reference them
 * using $fewbricks_common_fields['index_of_field']
 */

global $fewbricks_common_fields;

$fewbricks_common_fields = [];

/**
 *
 */
$fewbricks_common_fields['background_color'] = (new \fewbricks\acf\fields\select(
  'Background color', 'content_block_background_color', '1509072110d'))->set_settings([
  'choices' => [
    'none' => 'None',
    'red' => 'Red',
    'green' => 'Green',
    'blue' => 'Blue',
  ],
  'default_value' => 'none',
  'allow_null' => false,
]);

/**
 *
 */
$fewbricks_common_fields['vertical_alignment'] = new \fewbricks\acf\fields\select('Vertical alignment',
  'vertical_alignment', '1702122129a', [
    'choices' => [ // keys correspinds to Bootstraps valign classes
      'start' => 'Top',
      'center' => 'Middle',
      'end' => 'Bottom'
    ],
    'default_value' => 'start',
    'allow_null' => false,
  ]);
