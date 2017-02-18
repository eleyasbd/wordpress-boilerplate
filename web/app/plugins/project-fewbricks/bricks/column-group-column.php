<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;

class column_group_column extends project_brick
{

    /**
     *
     */
    public function set_fields()
    {

        $this->set_content_fields();
        $this->set_settings_fields();

    }

    /**
     *
     */
    private function set_content_fields()
    {

        $fc = new acf_fields\flexible_content('', 'column_modules', '17022210a', [
            'button_label' => 'Add column content',
        ]);

        $l = new layout('', 'headline', '17022210b');
        $l->add_brick(new headline('headline', '17022210c'));
        $fc->add_layout($l);

        $l = new layout('', 'button', '17022210d');
        $l->add_brick(new button('button', '17022210e'));
        $fc->add_layout($l);

        $l = new layout('', 'image', '17022210f');
        $l->add_brick(new image('image', '17022210g'));
        $fc->add_layout($l);

        $l = new layout('', 'list', '17022210h');
        $l->add_brick(new html_list('html_list', '17022210i'));
        $fc->add_layout($l);

        $l = new layout('', 'text', '17022210j');
        $l->add_brick(new wysiwyg('text', '17022210k'));
        $fc->add_layout($l);

        $l = new layout('', 'video', '17022210l');
        $l->add_brick(new youtube('video', '17022210m'));
        $fc->add_layout($l);

        $this->add_flexible_content($fc);


    }

    private function set_settings_fields()
    {

        $this->add_field(new acf_fields\message(
            'Column settings',
            'column_settings',
            '1702172207a'
        ));

        $this->add_field(new acf_fields\select(
            'Column width - desktop',
            'column-width-large-screens',
            '1702172250a',
            [
                'choices' => [
                    '100%' => '100%',
                    '75%' => '75%',
                    '50%' => '50%',
                    '33%' => '33%',
                    '25%' => '25%',
                ],
                'default_value' => '100%',
                'allow_null' => false
            ]
        ));

        $this->add_field(new acf_fields\select(
                'Horizontal alignment',
                'horizontal_alignment',
                '1702172207b',
                [
                    'choices' => [
                        'left' => 'Left',
                        'center' => 'Center',
                        'right' => 'Right',
                    ],
                    'default_value' => 'left',
                    'allow_null' => false,
                ])
        );

    }

}