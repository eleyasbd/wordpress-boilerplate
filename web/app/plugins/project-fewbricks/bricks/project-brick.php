<?php

/**
 * Use this class to add project specific brick stuff. This is to avoid having the brick class polluted with
 * irrelevant stuff and make it easier to identify neat new stuff that may be re-used for other projects.
 */

namespace fewbricks\bricks;

/**
 * Class project_brick
 * @package fewbricks\bricks
 */
class project_brick extends brick
{

    /**
     * @var bool
     */
    private static $headline_tag = false;

    /**
     * @param string $name
     * @param string $key
     */
    public function __construct($name = '', $key = '')
    {

        parent::__construct($name, $key);

    }

    /**
     * This function must exist regardless of if it has a body or not.
     * Called after set_fields have been called.
     * Use to add any fields that every brick in the project should have.
     */
    public function set_project_fields()
    {

    }

  /**
   * Executes a template file for the current class and returns the output.
   * Implements filter fewbricks/brick/brick_template_base_path allowing you to override where the template file
   * resides. Value returned by the hook should end with a slash. Note that the filter will only run if
   * the first argument to this funciton is false.
   * @param array $data
   * @param bool|string $template_base_path If you want to set a specific base path, pass it here. End with a slash.
   * @return string
   */
  protected function get_brick_template_html($data = [], $template_base_path = false)
  {

    return parent::get_brick_template_html($template_base_path, $data);

  }

    /**
     * @param $data_key
     * @param bool $value
     * @return string
     */
    protected function demo_get_headline_html($data_key, $value = false)
    {

        $this->demo_set_headline_tag();

        $headline = ($value !== false ? $value : $this->get_field($data_key));

        $html = '';

        if (!empty($headline)) {

            $html .= '<' . self::$headline_tag . '>' . $headline . '</' . self::$headline_tag . '>';

        }

        return $html;

    }

    /**
     *
     */
    protected function demo_set_headline_tag()
    {

        switch (self::$headline_tag) {

            case 'h1' :

                self::$headline_tag = 'h2';
                break;

            default :

                self::$headline_tag = 'h1';

        }

    }

}
