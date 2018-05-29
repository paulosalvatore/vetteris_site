<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 29/05/2018
 * Time: 17:06
 */

namespace App\OpenTibia;

use Cake\Utility\Xml;

class Server
{
	private static $serverFolder = "C:/Users/paulo/Desktop/OpenTibia/vetteris";
	private static $dataFolder = "data";

	public static function getDataFolder()
	{
		return Server::$serverFolder . DS . Server::$dataFolder . DS;
	}

	public static function getFolder($folder)
	{
		return Server::getDataFolder() . $folder . DS;
	}

	public static function getMonsterFolder()
	{
		return Server::getFolder("monster");
	}

	public static function getItemsFolder()
	{
		return Server::getFolder("items");
	}

	public static function getContent($file)
	{
		$fileContent = file_get_contents($file);
		$xml = Xml::build($fileContent);
		return Xml::toArray($xml);
	}
}
