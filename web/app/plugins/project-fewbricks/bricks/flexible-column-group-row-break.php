<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class flexible_column_group_row_break extends project_brick
{

    /**
     * @var string This will be the default label showing up in the editor area for the administrator.
     * It can be overridden by passing an item with the key "label" in the array that is the second argument when
     * creating a brick.
     */
    protected $label = 'Row break';

    /**
     * Set all the fields for the brick.
     */
    public function set_fields()
    {

        $this->add_field(new acf_fields\message('Info', 'row_break_message', '1702172254', [
            'message' => 'This module will place the next column on a new row. <b>Screen size settings?</b>',
        ]));

    }

    /**
     * This function will be used in the frontend when displaying the brick.
     * It will be called by the parents class function get_html(). See that function
     * for info on what data you have at your disposal.
     * @return string
     */
    protected function get_brick_html()
    {

        return $this->get_brick_template_html();

    }

}