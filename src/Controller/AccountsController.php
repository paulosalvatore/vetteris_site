<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 28/05/2018
 * Time: 16:05
 */

namespace App\Controller;

use Cake\Event\Event;

class AccountsController extends AppController
{
	public function index()
	{
	}

	public function signin()
	{
		if (isset($this->account["id"]))
			return $this->redirect(["action" => "index"]);

		if ($this->request->is("post"))
		{
			$account = $this->Auth->identify();
			$this->Accounts->registerNewLogin($account["id"], $this->request);

			if ($account)
			{
				$this->Auth->setUser($account);

				return $this->redirect(
					isset($this->request->getQuery()["redirect"])
						? $this->request->getQuery()["redirect"]
						: ["action" => "index"]
				);
			}
			else
			{
				$this->Flash->error(__("Incorrect account name or password."));
			}
		}
	}

	public function signout()
	{
		$this->Flash->success(__("You have logged out."));

		return $this->redirect($this->Auth->logout());
	}

	public function signup()
	{
		// Criação de Conta Teste
		$account = $this->Accounts->newEntity(
			[
				"name" => time(),
				"password" => "02991040",
				"confirm_password" => "02991040",
				"email" => (intval(time() / 100)) . "@paulo.com"
			]
		);
		debug($account);
		debug($this->Accounts->save($account));
	}

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);

		$this->Auth->allow(
			[
				"signup"
			]
		);
	}
}
