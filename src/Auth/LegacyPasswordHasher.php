<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 28/05/2018
 * Time: 17:47
 */

namespace App\Auth;

use Cake\Auth\AbstractPasswordHasher;

class LegacyPasswordHasher extends AbstractPasswordHasher
{
	public function hash($password)
	{
		return sha1($password);
	}

	public function check($password, $hashedPassword)
	{
		return sha1($password) === $hashedPassword;
	}
}
