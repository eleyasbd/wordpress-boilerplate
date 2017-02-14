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
            'param' => 'options_page',
            'operator' => '==',
            'value' => 'acf-options-cookie-alert',
        ],
    ]
];

$fewbricks_fg = (new fewacf\field_group('Cookie alert', '1702141141a', $fewbricks_fg_location, 10, [
    'style' => 'seamless'
]));

$fewbricks_fg->add_field(new acf_fields\wysiwyg('Text', 'cookie_alert_text', '1702141141a', [
    'media_upload' => false,
    'toolbar' => 'basic',
    'required' => true,
    'default_value' => 'This site uses cookies. By continuing to browse the site, you are agreeing to our use of cookies.'
]));

$fewbricks_fg->add_field(new acf_fields\text('Button text', 'cookie_alert_agree_button_text', '1702141141b', [
    'default_value' => 'OK',
    'required' => true,
]));

$fewbricks_fg->add_field(new acf_fields\wysiwyg('Text for no JavaScript', 'cookie_alert_no_js_text', '1702141145a', [
    'instructions' => 'Visitors must have JavaScript enabled in order to be able to accept cookies and hide the cookie alert. Text entered here will be displayed instead of the cookie alert for users with JavaScript disabled .',
    'default_value' => 'You must have JavaScript activated in your browser to be able to hide this information. See <a href="http://enable-javascript.com/" target="_blank">http://enable-javascript.com</a> for more info on how to enable JavaScript.',
]));

$fewbricks_fg->register();

