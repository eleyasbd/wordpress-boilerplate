<?php

// Based on https://github.com/Smartik89/SMK-Theme-View/blob/master/functions.php
// Heavily modified to be more in line with the original WP-function get_template_part()

namespace Folbert;

class Templating
{

  /**
   * @var array
   */
  private $data;

  /**
   * @var
   */
  private $templates;

  /**
   * ThemeView constructor.
   * @param $templates
   * @param array $data
   */
  public function __construct($templates, $data = array())
  {

    $this->templates = $templates;
    $this->data = $data;

  }

  /**
   * @param $name
   * @return mixed
   */
  public function __get($name)
  {
    return $this->data[$name];
  }

  /**
   * @param $name
   * @return bool
   */
  public function __isset($name)
  {
    return isset($this->data[$name]);
  }

  /**
   * @param $data
   */
  public function render($data)
  {

    $located_template = locate_template($this->templates);

    if (!empty($located_template)) {

      include($located_template);

    } else {

      die('Templating could not locate any of the files <pre>' . print_r($this->templates) . '</pre>.');
    }

  }

  /**
   * @param $slug Same as $slug for get_template_part() from WP core
   * @param null $name Same as $name for get_template_part() from WP core
   * @param array $data
   * @param bool $echo
   * @return string
   */
  public static function get_template_part($slug, $name = null, $data = [], $echo = true)
  {

    // Most of the code below is copied from  the original get_template_part()
    // found in WP core.
    /**
     * Fires before the specified template part file is loaded.
     *
     * The dynamic portion of the hook name, `$slug`, refers to the slug name
     * for the generic template part.
     *
     * @since 3.0.0
     *
     * @param string $slug The slug name for the generic template.
     * @param string|null $name The name of the specialized template.
     */
    do_action("get_template_part_{$slug}", $slug, $name);

    $templates = array();
    $name = (string)$name;
    if ('' !== $name) {
      $templates[] = "{$slug}-{$name}.php";
    }

    $templates[] = "{$slug}.php";

    //locate_template($templates, true, false);
    // End of original WP core code

    $template = new self($templates, $data);

    if ($echo) {

      $template->render($data);

    } else {

      ob_start();
      $template->render();
      return ob_get_clean();

    }

  }

}
