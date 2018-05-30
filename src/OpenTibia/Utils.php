<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 29/05/2018
 * Time: 17:27
 */

namespace App\OpenTibia;

class Utils
{
	public static function clearArray($array)
	{
		foreach ($array as $key => $value)
		{
			if (is_array($value))
				$array[$key] = Utils::clearArray($value);
			else if (strpos($key, "@") >= 0)
			{
				$newKey = str_replace("@", "", $key);
				$array[$newKey] = $value;
				unset($array[$key]);
			}
		}

		return $array;
	}

	public static function formatName($name)
	{
		return ucwords($name);
	}
}
