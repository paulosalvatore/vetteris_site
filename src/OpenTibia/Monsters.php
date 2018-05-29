<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 29/05/2018
 * Time: 16:30
 */

namespace App\OpenTibia;

class Monsters
{
	/**
	 * Monsters constructor.
	 * @param $array
	 */
	public function __construct($array)
	{
		$array = Utils::clearArray($array);

		foreach ($array as $key => $value)
			$this->$key = $value;
	}

	public static function loadMonsters()
	{
		$folder = Server::getMonsterFolder();

		$array = Server::getContent($folder . "monsters.xml");

		return $array["monsters"]["monster"];
	}

	public static function loadMonster($monsterFilename)
	{
		$file = Server::getMonsterFolder() . $monsterFilename;

		$array = Server::getContent($file);

		return new Monsters($array["monster"]);
	}

	public function getLootIds()
	{
		$itemsIds = [];

		if (isset($this->loot))
			$itemsIds = $this->getItemsIds($this->loot);

		return $itemsIds;
	}

	private function getItemsIds($items)
	{
		$itemsIds = [];

		$items = $items["item"];

		if (array_key_exists("id", $items))
			$items = [$items];

		foreach ($items as $item)
		{
			$itemsIds[] = $item["id"];

			if (array_key_exists("item", $item))
				$itemsIds =
					array_merge(
						$itemsIds,
						$this->getItemsIds($item)
					);
		}

		return $itemsIds;
	}
}
