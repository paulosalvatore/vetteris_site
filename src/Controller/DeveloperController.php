<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 28/05/2018
 * Time: 22:32
 */

namespace App\Controller;

use App\OpenTibia\Items;
use App\OpenTibia\Monsters;
use Cake\Utility\Xml;

class DeveloperController extends AppController
{
	public function index()
	{
	}

	public function monstersXml()
	{
		if ($this->request->is("post"))
		{
			$data = $this->request->getData();

			$loot = $data["loot"] == "1";

			$monstersLoot = [];

			foreach ($data["monsters"] as $monsterFilename)
			{
				if ($monsterFilename == "0")
					continue;

				$monster = Monsters::loadMonster($monsterFilename);

				if ($loot)
				{
					$monsterLoot = $monster->getLootIds();
					$monstersLoot =
						array_merge(
							$monstersLoot,
							$monsterLoot
						);
				}
			}

			if ($loot)
			{
				$monstersLoot = array_unique($monstersLoot);
				sort($monstersLoot);

				return $this->redirect([
					"action" => "items_xml",
					 base64_encode(json_encode($monstersLoot))
				]);
			}
		}

		$monsters = Monsters::loadMonsters();
		$this->set("monsters", $monsters);
	}

	public function itemsXml($itemsIds = null)
	{
		$itemsIds = json_decode(base64_decode($itemsIds));

		if ($itemsIds)
		{
			$items = Items::loadItems($itemsIds);

			$this->set("items", $items);
		}
		else
		{
			$this->Flash->error(__("No items to show."));

			return $this->redirect([
				"action" => "index"
			]);
		}
	}
}
