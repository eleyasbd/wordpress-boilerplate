<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;

class flexible_column_group_column extends project_brick
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

        $fc = new acf_fields\flexible_content('Column content', 'column_modules', '17022210a', [
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
            'Column width',
            'column_width',
            '1702172250a',
            [
                'choices' => [
                    '12' => '12/12',
                    '11' => '11/12',
                    '10' => '10/12',
                    '9' => '9/12',
                    '8' => '8/12',
                    '7' => '7/12',
                    '6' => '6/12',
                    '5' => '5/12',
                    '4' => '4/12',
                    '3' => '3/12',
                    '2' => '2/12',
                    '1' => '1/12',
                ],
                'default_value' => '12',
                'allow_null' => false,
                'instructions' => 'Column widths are based on a 12-column system. Selecting for example 12/12 will result in a column spanning the entire width of the row. 6/12 would have the column span 50% of the row. If you place two or more columns with a combined column width of more than 12 (for example a 9/12 and one 4/12 or two 5/12 and one 7/12), the system will calculate the row breaks for you. The first example would result in one row with a 9/12 column and another row with 4/12 whereas the second example would render one row with two 5/12 and one row with 7/12.<br> Note that these columns only are used on screens above a certain screen size. On smaller screens (basically phones held horizontally and smaller) we will stack the columns on top of each other regardless of the column setting.'
            ]
        ));

        $this->add_field(new acf_fields\true_false('Preserve column width on small screens', 'preserve_column_width_on_small_screens', '1702201532a'));

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

    /**
     * @return array
     */
    private function get_view_data() {

        $view_data = [];

        $view_data['column_css_classes'] = $this->get_html_args['column_css_classes'];

        $view_data['content'] = '';

        dump($this->have_rows('content'));

        while ($this->have_rows('content')) {

            $this->the_row();

            echo 'A';

            $view_data['content'] .= acf_fields\flexible_content::get_sub_field_brick_instance()->get_html();

        }

        return $view_data;

    }

    /**
     * @return string
     */
    protected function get_brick_html()
    {

        $view_data = $this->get_view_data();

        return $this->get_brick_template_html($view_data);

    }

}