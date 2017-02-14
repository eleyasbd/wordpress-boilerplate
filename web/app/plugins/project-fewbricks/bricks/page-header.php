<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class page_header extends project_brick
{

    /**
     * @var string This will be the default label showing up in the editor area for the administrator.
     * It can be overridden by passing an item with the key "label" in the array that is the second argument when
     * creating a brick.
     */
    protected $label = 'Page header';

    /**
     * Set all the fields for the brick.
     */
    public function set_fields()
    {

        /*$this->add_field(new acf_fields\select('Type', 'type', '1702141311a', [
                'choices' => [
                    '' => 'None',
                    'type-1' => 'Type 1',
                    'type-2' => 'Type 2',
                    'type-3' => 'Type 3',
                ],
                'allow_null' => false,
                'default_value' => '',
                'required' => true,
            ]
        ));*/

        $this->add_field(new acf_fields\text('Headline - Line 1', 'headline_line_1', '1702141336a'));
        $this->add_field(new acf_fields\text('Headline - Line 2', 'headline_line_2', '1702141336b'));
        $this->add_field(new acf_fields\image('Background image', 'background_image', '1702141524a'));

    }

    /**
     * @return array
     */
    private function get_view_data()
    {

        $view_data = [];
        $view_data['type'] = $this->get_field('type');
        $view_data['headline_line_1'] = $this->get_field('headline_line_1');
        $view_data['headline_line_2'] = $this->get_field('headline_line_2');
        $view_data['background_image'] = $this->get_field('background_image');
        $view_data['css_modifier_suffix'] = $view_data['type'];

        return $view_data;

    }

    /**
     * This function will be used in the frontend when displaying the brick.
     * It will be called by the parents class function get_html(). See that function
     * for info on what data you have at your disposal.
     * @return string
     */
    protected function get_brick_html()
    {

        $outcome = '';

        //if(!empty($this->get_field('type'))) {

            $data = $this->get_view_data();
            $data['in_container'] = (is_array($this->get_html_args) && $this->get_html_args['in_container']);

            //ob_start();
            /** @noinspection PhpIncludeInspection */
            //include(get_template_directory() . '/templates/modules/page-header-' . $data['type'] . '.view.php');
            //$outcome = ob_get_clean();

            $outcome = $this->get_brick_template_html($data);

        //}

        return $outcome;

    }

}