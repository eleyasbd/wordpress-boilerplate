<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class column_group extends project_brick
{

    /**
     * @var string This will be the default label showing up in the editor area for the administrator.
     * It can be overridden by passing an item with the key "label" in the array that is the second argument when
     * creating a brick.
     */
    protected $label = 'Column Collection';

    /**
     *
     */
    public function set_fields()
    {

        $fc = new acf_fields\flexible_content('Content', 'content', '1702172201a', [
            'button_label' => 'Add',
        ]);

        $layout = new layout('Column', 'column', '1702172201b');
        $layout->add_brick((new column_group_column('Column', '1702172201c')));
        $fc->add_layout($layout);

        $layout = new layout('Row break', 'row_break', '17012172247a');
        $layout->add_brick((new column_group_row_break('Row break', '17012172247b')));
        $fc->add_layout($layout);

        $this->add_flexible_content($fc);

    }



    /**
     * @param $column_nr
     */
    private function set_column_content_fields($column_nr) {

        $fc = new acf_fields\flexible_content('', 'column_' . $column_nr . '_modules', '1509111554i' . $column_nr, [
            'button_label' => 'Add column content',
        ]);

        $l = new layout('', 'headline', '1603250048a' . $column_nr);
        $l->add_brick(new headline('headline', '1603250048b' . $column_nr));
        $fc->add_layout($l);

        $l = new layout('', 'button', '1509111557u' . $column_nr);
        $l->add_brick(new button('button', '1509111556s' . $column_nr));
        $fc->add_layout($l);

        $l = new layout('', 'image', '1702112210a' . $column_nr);
        $l->add_brick(new image('image', '1702112210b' . $column_nr));
        $fc->add_layout($l);

        $l = new layout('', 'list', '1702131839o' . $column_nr);
        $l->add_brick(new html_list('html_list', '1702131839p' . $column_nr));
        $fc->add_layout($l);

        $l = new layout('', 'text', '1603250054a' . $column_nr);
        $l->add_brick(new wysiwyg('text', '1603250054b' . $column_nr));
        $fc->add_layout($l);

        $l = new layout('', 'video', '1509111555a' . $column_nr);
        $l->add_brick(new youtube('video', '1509111556x' . $column_nr));
        $fc->add_layout($l);

        $this->add_flexible_content($fc);

    }

    /**
     *
     */
    private function set_settings_fields() {

        $this->add_field(new acf_fields\tab('Row settings', 'settings', '1702121052a'));

        $this->set_column_layout_setting_fields();

        if($this->get_arg('nr_of_columns') > 1) {

            $this->add_common_field('vertical_alignment', '1702122148a', [
                'label' => 'Row - Columns vertical alignment'
            ]);

        }

        $this->add_field(new acf_fields\select('Row - Vertical padding', 'vertical_padding', '1702130048a', [
            'choices' => [
                'standard' => 'Standard',
                'medium' => 'Medium',
                'small' => 'Small',
                'none' => 'None'
            ],
            'default_value' => 'standard',
            'allow_null' => false,
        ]));

    }

    /**
     *
     */
    private function set_column_layout_setting_fields() {

        // The array key refers to the nr of columns for which the choices should
        // be available.
        $choices = [
            2 => [
                'evenly' => 'Evenly distributed',
                '60_40' => '60/40',
            ],
            3 => [
                'evenly' => 'Evenly distributed',
                'center_hero' => 'Wider center column'
            ],
            4 => [
                'evenly' => 'Evenly distributed'
            ],
        ];

        if(isset($choices[$this->get_arg('nr_of_columns')])) {

            $this->add_field(new acf_fields\select('Row - Column layout', 'column_layout', '1702130049a', [
                'choices' => $choices[$this->get_arg('nr_of_columns')],
                'default_value' => 'evenly',
                'allow_null' => false,
            ]));

        }

    }

    /**
     * @return string
     */
    public function get_columns_css_classes()
    {

        switch ($this->get_field('nr_of_columns')) {

            case '4' :

                $column_classes = $this->get_4_columns_css_classes();
                break;

            case '3' :

                $column_classes = $this->get_3_columns_css_classes();
                break;

            case '2' :

                $column_classes = $this->get_2_columns_css_classes();
                break;

            default : // Most likely 1
                $column_classes = $this->get_1_column_css_classes();
                break;

        }

        return $column_classes;

    }

    /**
     * @return string
     */
    private function get_4_columns_css_classes() {

        $nr_of_columns = 4;
        $css_classes = [];

        for($column_nr = 1; $column_nr <= $nr_of_columns; $column_nr++) {

            $css_classes[$column_nr] = 'col-md-3';

        }

        return $css_classes;

    }

    /**
     * @return string
     */
    private function get_3_columns_css_classes() {

        $css_classes = [];

        switch($this->get_field('column_layout')) {

            case 'center_hero' :

                $css_classes[1] = 'col-md-3';
                $css_classes[2] = 'col-md-6';
                $css_classes[3] = 'col-md-3';

                break;

            default :

                $css_classes[1] = 'col-md-4';
                $css_classes[2] = 'col-md-4';
                $css_classes[3] = 'col-md-4';

        }

        return $css_classes;

    }

    /**
     * @return string
     */
    private function get_2_columns_css_classes() {

        $css_classes = [];

        switch($this->get_field('column_layout')) {

            case '60_40' :

                $css_classes[1] = 'col-md-7';
                $css_classes[2] = 'col-md-5';

                break;

            default :

                $css_classes[1] = 'col-md-6';
                $css_classes[2] = 'col-md-6';

        }

        return $css_classes;

    }

    /**
     * @return string
     */
    private function get_1_column_css_classes() {

        $css_classes[1] = 'col-md-12';

        return $css_classes;

    }

    /**
     *
     */
    private function get_view_data() {

        $view_data = [];

        $view_data['nr_of_columns'] = $this->get_field('nr_of_columns');
        $view_data['column_layout'] = $this->get_field('column_layout');

        $view_data['vertical_alignment'] = $this->get_field('vertical_alignment');
        if(empty($view_data['vertical_alignment'])) {
            $view_data['vertical_alignment'] = 'top';
        }

        $view_data['vertical_padding'] = $this->get_field('vertical_padding');

        $view_data['column_data'] = $this->get_view_data_for_columns();

        return $view_data;

    }

    /**
     * @return array
     */
    private function get_view_data_for_columns() {

        $data = [];

        for($column_nr = 1; $column_nr <= $this->get_field('nr_of_columns'); $column_nr++) {

            $data[$column_nr] = [];
            $data[$column_nr]['horizontal_alignment'] = $this->get_field('horizontal_alignment_col_' . $column_nr);

        }


        return $data;

    }

    /**
     * @return string
     */
    protected function get_brick_html()
    {

        $view_data = $this->get_view_data();

        $view_data['css_block_class'] = $this->get_html_args['block_css_class'];

        return $this->get_brick_template_html($view_data);

    }

}
