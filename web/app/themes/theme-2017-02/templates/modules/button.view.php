<?php

if (isset($data['class'])) {
  $data['class'] = 'btn ' . $data['class'];
} else {
  $data['class'] = 'btn';
}

if(!empty($this->css_class)) {

  $data['class'] .= ' ' . $this->css_class;

}

$html = '<a';
$html .= ' href="' . $data['href'] . '"';
$html .= ' class="' . $data['class'] . '"';
$html .= ($this->get_field('target_blank') ? ' target="_blank"' : '');
$html .= '>';
$html .= $this->get_field('text');
$html .= '</a>';

echo $html;
