<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;
use fewbricks\project\bootstrap_grid_generator;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class flexible_column_group extends project_brick
{

    /**
     * @var string This will be the default label showing up in the editor area for the administrator.
     * It can be overridden by passing an item with the key "label" in the array that is the second argument when
     * creating a brick.
     */
    protected $label = 'Flexible Column Group';

    /**
     * @var
     */
    private $cached_layouts;

    /**
     *
     */
    public function set_fields()
    {

        $this->set_content_fields();
        $this->set_settings_fields();

    }

    private function set_content_fields()
    {

        $this->add_field(new acf_fields\tab($this->get_setting('label') . ' - Columns', 'settings', '1702201255a'));

        $fc = new acf_fields\flexible_content('', 'content', '1702172201a', [
            'button_label' => 'Add column or row break',
        ]);

        $layout = new layout('Column', 'column', '1702172201b');
        $layout->add_brick((new flexible_column_group_column('Column', '1702172201c')));

        $layout->set_setting('display', 'block');
        $fc->add_layout($layout);

        $layout = new layout('Row break', 'row_break', '17012172247a');
        $layout->add_brick((new flexible_column_group_row_break('Row break', '17012172247b')));
        $fc->add_layout($layout);

        $this->add_flexible_content($fc);

    }

    /**
     *
     */
    private function set_settings_fields()
    {

        $this->add_field(new acf_fields\tab($this->get_setting('label') . ' - Settings', 'settings', '1702201255b'));

        $this->add_common_field('vertical_alignment', '1702201255c', [
            'label' => 'Row - Columns vertical alignment'
        ]);

        $this->add_common_field('color_scheme_1', '1702211451a');

        $this->add_field(new acf_fields\image('Background image', 'background_image', '1702211441a'));
        $this->add_common_field('color_1', '1702211455a');

    }

    /**
     *
     */
    private function set_cached_layouts()
    {

        $this->cached_layouts = [];

        while ($this->have_rows('content')) {

            $this->the_row();
            /** @var brick $layout */
            $layout = acf_fields\flexible_content::get_sub_field_brick_instance();

            // Set column width as custom data here since we will be outside the loop later on
            // which will make it hard for us to get the data then.
            $layout->set_data_item('column_width', $layout->get_field('column_width'));
            $layout->set_data_item('content_html', $layout->get_html());

            $this->cached_layouts[] = $layout;

        }

    }

    /**
     * @return mixed
     */
    private function get_cached_layouts()
    {

        if (empty($this->cached_layouts)) {
            $this->set_cached_layouts();
        }

        return $this->cached_layouts;

    }

    /**
     *
     */
    private function get_nr_of_columns()
    {

        $nr_of_columns = 0;

        foreach ($this->get_cached_layouts() AS $layout) {

            if ($layout instanceof flexible_column_group_column) {
                $nr_of_columns++;
            }

        }

        return $nr_of_columns;

    }

    /**
     * @return array
     */
    private function get_rows()
    {

        $grid_generator = new bootstrap_grid_generator($this->get_cached_layouts(), 'column-width',
            ['flexible_column_group_row_break']);

        return $grid_generator->get_rows();

    }

    /**
     *
     */
    private function get_view_data()
    {

        $view_data = [];
        $view_data['layouts'] = $this->get_cached_layouts();
        $view_data['nr_of_columns'] = $this->get_nr_of_columns();
        $view_data['rows'] = $this->get_rows();

        $view_data['vertical_alignment'] = $this->get_field('vertical_alignment');

        $view_data['css_block_class'] = $this->get_html_args['block_css_class'];

        $view_data['vertical_padding'] = $this->get_field('vertical_padding');

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
