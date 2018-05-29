<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 07/07/2017
 * Time: 12:43
 */

namespace App\Model\Table;

use Cake\I18n\FrozenTime;
use Cake\ORM\Table;

class DbChangeLogTable extends Table
{
	public function initialize(array $config)
	{
		$this->addBehavior(
			"Timestamp",
			[
				"events" => [
					"Model.beforeSave" => [
						"created" => "new"
					]
				]
			]
		);

		$this->setTable("db_changelog");
	}

	public function saveChanges($changes)
	{
		if (count($changes) == 0)
			return;

		$entities = $this->newEntities($changes);

		foreach ($entities as $entity)
			$this->save($entity);
	}
}
