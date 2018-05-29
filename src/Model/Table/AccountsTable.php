<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 28/05/2018
 * Time: 16:52
 */

namespace App\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\I18n\FrozenTime;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AccountsTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);

		// $this->belongsTo("HistoricosAuditoria");

		$this->setTable("accounts");
		$this->setDisplayField("name");
	}

	public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
	{
		if ($entity->isNew())
			$entity->creation = time();
	}

	public function validationDefault(Validator $validator)
	{
		$validator
			->requirePresence("name", "create")
			->notEmpty("name");

		$validator
			->requirePresence("password", "create")
			->notEmpty("password")
			->minLength("password", 8, __("Your password must contains at least 8 characters."));

		$validator
			->add(
				"password", "confirm_password",
				[
					"rule" => function ($value, $context) {
						return
							isset($context["data"]["confirm_password"]) &&
							$context["data"]["confirm_password"] === $value;
					},
					"message" => __("Please confirm your password correctly.")
				]
			);

		$validator
			->email("email")
			->requirePresence("email", "create")
			->notEmpty("email");

		return $validator;
	}

	public function buildRules(RulesChecker $rules)
	{
		$rules
			->add(
				$rules->
				isUnique(
					["name"],
					__("There's already an account with this account name. Please try another.")
				)
			);

		$rules
			->add(
				$rules->
				isUnique(
					["email"],
					__("There's already an account with this email. Please try another.")
				)
			);

		return $rules;
	}

	public function getList()
	{
		return
			$this
				->find("list")
				->toArray();
	}

	public function getAll()
	{
		return
			$this
				->find()
				->toArray();
	}

	public function getId($id)
	{
		$query =
			$this
				->find()
				->where(
					[
						"Accounts.id" => $id
					]
				)
				->first();

		if ($query == null)
			throw new Exception(__("There's no register recorded with this ID."));

		return $query;
	}

	public function registerNewLogin($accountId, $request)
	{
		$account = $this->getId($accountId);

		$account = $this->patchEntity(
			$account,
			[
				"last_login" => FrozenTime::now(),
				"ip" => $request->clientIp()
			]
		);

		$this->save($account);
	}
}
