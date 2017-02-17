<?php

namespace Folbert\FbtWpBpFuncPlug\Shared;

class Helper {

	/**
	 * @param $array
	 * @param string $quotation_mark
	 * @return string
	 */
	public static function assoc_array_to_elm_attributes_string($array, $quotation_mark= '"') {

		$string = '';

		foreach($array AS $key => $value) {

			$string .= $key . '=' . $quotation_mark . $value . $quotation_mark;

		}

		return $string;

	}

}
