<?php

/**
 * Do not delete this file!
 */

// https://www.advancedcustomfields.com/resources/acf_add_options_page/
acf_add_options_page([
    'page_title' => 'Options',
    'menu_slug' => 'acf-options',
]);
// https://www.advancedcustomfields.com/resources/acf_add_options_sub_page/
acf_add_options_sub_page([
    'page_title' => 'Cookie Alert',
    'menu_slug' => 'acf-options-cookie-alert',
    'parent_slug' => 'acf-options',
]);

/**
 * Use this file to require all other field group.
 * DO NOT use require_once since that will break stuff.
 */

require(__DIR__ . '/fewbricks-field-groups-page-header.php');
require(__DIR__ . '/fewbricks-field-groups-content-1.php');
require(__DIR__ . '/fewbricks-field-groups-options-cookie-alert.php');
//require(__DIR__ . '/field-group-template-fewbricks-demo.php');
