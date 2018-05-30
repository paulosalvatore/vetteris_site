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

		if (isset($this->name))
			$this->name = Utils::formatName($this->name);
	}

	public static function loadMonsters($loadFile = false)
	{
		$folder = Server::getMonsterFolder();
		$array = Server::getContent($folder . "monsters.xml");
		$array = Utils::clearArray($array["monsters"]["monster"]);

		if ($loadFile)
			foreach ($array as $key => $value)
				$array[$key] = Monsters::loadMonster($value["file"]);

		return $array;
	}

	public static function loadMonstersLootByFiles($files)
	{
		$monstersLoot = [];

		foreach ($files as $filename)
		{
			if ($filename == "0")
				continue;

			$monster = Monsters::loadMonster($filename);

			$monsterLoot = $monster->getLootIds();
			$monstersLoot =
				array_merge(
					$monstersLoot,
					$monsterLoot
				);
		}

		$monstersLoot = array_unique($monstersLoot);
		sort($monstersLoot);

		return $monstersLoot;
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

	public function checkLootItemById($itemId)
	{
		return in_array($itemId, $this->getLootIds());
	}
}
