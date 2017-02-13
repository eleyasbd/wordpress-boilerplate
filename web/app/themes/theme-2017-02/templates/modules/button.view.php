<?php

$btn_elm_class_value = 'btn btn-primary';

$html = '<a';
$html .= ' href="' . $data['href'] . '"';
$html .= ' class="' . $btn_elm_class_value . '"';
$html .= ($data['open_in_new_window'] ? ' target="_blank"' : '');
$html .= '>';
$html .= $data['text'];
$html .= '</a>';

echo $html;
