<?php

/**
 * RankSystem - Utils.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\utils;

class Utils {

	/**
	 * @param array $array
	 * @return string
	 */
	public static function permArrayToString(array $array) : string {
		return implode(";", $array);
	}

	/**
	 * @param string $string
	 * @return array
	 */
	public static function permStringToArray(string $string) : array  {
		return explode(";", $string);
	}
}