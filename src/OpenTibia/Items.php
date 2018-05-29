<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 29/05/2018
 * Time: 17:54
 */

namespace App\OpenTibia;

class Items
{
	/**
	 * Items constructor.
	 * @param $array
	 */
	public function __construct($array, $id = null)
	{
		if ($id)
			$this->id = $id;

		foreach ($array as $key => $value)
			$this->$key = $value;

		$this->formatName();

		$this->loadImage();
	}

	public static function loadItems($itemsIds = null)
	{
		$folder = Server::getItemsFolder();

		$array = Server::getContent($folder . "items.xml");

		$array = $array["items"]["item"];

		$array = Utils::clearArray($array);

		$items = [];

		foreach ($array as $value)
		{
			if (array_key_exists("fromid", $value))
			{
				for ($i = $value["fromid"]; $i <= $value["toid"]; $i++)
					if (Items::checkLoadItem($itemsIds, $i))
						$items[] = new Items($value, $i);
			}
			else if (Items::checkLoadItem($itemsIds, $value["id"]))
				$items[] = new Items($value);
		}

		return $items;
	}

	private function formatName()
	{
		if (isset($this->name))
			$this->name = ucwords($this->name);
	}

	private function loadImage()
	{
		$imageFolder = "../webroot/img/";
		$itemsFolder = "items/";
		$imageFile = $itemsFolder . $this->id . ".gif";

		if (file_exists($imageFolder . $imageFile))
			$this->image = $imageFile;
		else
			$this->image = $itemsFolder . "not_found.gif";
	}

	private static function checkLoadItem($itemsIds, $id)
	{
		if (is_array($itemsIds))
			return in_array($id, $itemsIds);

		return true;
	}
}
