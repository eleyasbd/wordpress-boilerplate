<?php

namespace fewbricks\project;

/**
 * Class grid_generator
 * @package fewbricks
 */
class bootstrap_grid_generator
{

    /**
     * ACF layouts
     * @var
     */
    private $layouts;

    /**
     * @var
     */
    private $row_break_php_class_names;

    /**
     * @var int
     */
    private $max_nr_of_columns_in_row;

    /**
     * @var
     */
    private $column_width_setting_name;

    /**
     * Bootstrap rows
     * @var
     */
    private $rows;

    /**
     * bootstrap_grid_generator constructor.
     * @param $layouts
     * @param $column_width_setting_name
     * @param array $row_break_php_class_names
     * @param int $max_nr_of_columns_in_row
     */
    public function __construct(
        $layouts,
        $column_width_setting_name,
        $row_break_php_class_names = [],
        $max_nr_of_columns_in_row = 12
    ) {

        $this->layouts = $layouts;

        $this->max_nr_of_columns_in_row = $max_nr_of_columns_in_row;

        $this->row_break_php_class_names = $row_break_php_class_names;
        if (!is_array($this->row_break_php_class_names)) {
            $this->row_break_php_class_names = [$this->row_break_php_class_names];
        }

        $this->column_width_setting_name = $column_width_setting_name;

    }

    /**
     *
     */
    public function get_rows()
    {

        $rows = [];
        $row_index = 1;
        $row_total_columns = [];
        $layout_index_in_row = 1;

        foreach ($this->layouts AS $layout) {

            // Make sure that we start with 0 columns for each row
            if (!isset($row_total_columns[$row_index])) {
                $row_total_columns[$row_index] = 0;
            }

            $layout_is_row_break = $this->layout_is_row_break($layout);

            $new_row = $layout_is_row_break || $row_total_columns[$row_index] >= $this->max_nr_of_columns_in_row;

            if ($new_row) {
                $row_index++;
                $row_total_columns[$row_index] = 0;
            }

            // Add the layout to the row
            if(!$layout_is_row_break) {

                $row_total_columns[$row_index] += $layout->get_data_item('column_width');
                $rows[$row_index][] = $layout;

            }

            $layout_index_in_row++;

        }

        return $rows;

    }

    /**
     * @param $layout
     * @return bool
     */
    private function layout_is_row_break($layout)
    {

        $outcome = false;

        foreach ($this->row_break_php_class_names AS $row_break_php_class_name) {

            $classname = get_class($layout);

            if (substr($classname, strrpos($classname, '\\') + 1) === $row_break_php_class_name) {
                $outcome = true;
                break;
            }

        }

        return $outcome;


    }

}