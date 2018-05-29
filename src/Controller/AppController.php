<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Aura\Intl\Exception;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\Network\Exception\MethodNotAllowedException;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	public $account;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent("Security");`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        try
        {
	        $this->loadComponent("RequestHandler", [
		        "enableBeforeRedirect" => false,
	        ]);
	        $this->loadComponent("Flash");
	        $this->loadComponent("Cookie");
	        $this->loadComponent("Auth",
		        [
			        "authenticate" => [
				        "Form" => [
					        "userModel" => "Accounts",
					        "fields" => [
						        "username" => "name",
						        "password" => "password"
					        ],
					        "passwordHasher" => [
						        "className" => "Legacy",
					        ]
				        ]
			        ],
			        "loginAction" => [
				        "controller" => "Accounts",
				        "action" => "signin"
			        ],
			        "authError" => __("Access denied: You are not authorized to access this page.")
		        ]
	        );
        }
        catch (\Exception $e)
        {
        }

	    $this->account = $this->updateAccount();
	    $this->set("account", $this->account);

	    $this->Cookie->setConfig("path", "/");
	    $this->Cookie->setConfig([
		    "expires" => "+1 year",
		    "httpOnly" => true
	    ]);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        // $this->loadComponent("Security");
        // $this->loadComponent("Csrf");
    }

	protected function writeOnSession($field, $data = "")
	{
		$this->request->getSession()->write($field, $data);
	}

	protected function readFromSession($field)
	{
		return $this->request->getSession()->read($field);
	}

	public function restrictedAccess()
	{
		if (!$this->account ||
			($this->account && !$this->account["administrador"]))
			throw new MethodNotAllowedException();
	}

	protected function updateAccount()
	{
		$accountSession = $this->readFromSession("Auth.User");

		if (is_array($accountSession))
		{
			$this->loadModel("Accounts");

			$account =
				$this
					->Accounts
					->getId($accountSession["id"]);

			$account = json_encode($account);
			$account = json_decode($account, true);

			$newAccountSession =
				array_merge(
					$accountSession,
					$account,
					[
						"connected" => true
					]
				);

			$this->writeOnSession("Auth.User", $newAccountSession);

			return $newAccountSession;
		}

		return [
			"admin_website" => false,
			"connected" => false
		];
	}
}
