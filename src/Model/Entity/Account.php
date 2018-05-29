<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 28/05/2018
 * Time: 17:13
 */

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Account extends Entity
{
	protected $_accessible = [
		"*" => true,
		"id" => false
	];

	protected $_hidden = [
		"password"
	];

	protected function _setPassword($password)
	{
		return sha1($password);
	}
}
