<?php

if (isset($viewData['class'])) {
  $viewData['class'] = 'btn ' . $viewData['class'];
} else {
  $viewData['class'] = 'btn';
}

if(!empty($this->css_class)) {

  $viewData['class'] .= ' ' . $this->css_class;

}

$html = '<a';
$html .= ' href="' . $viewData['href'] . '"';
$html .= ' class="' . $viewData['class'] . '"';
$html .= ($this->get_field('target_blank') ? ' target="_blank"' : '');
$html .= '>';
$html .= $this->get_field('text');
$html .= '</a>';

echo $html;
