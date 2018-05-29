<?php
use Migrations\AbstractMigration;

class ChangeAccountsTable extends AbstractMigration
{
    public function change()
    {
    	$table = $this->table("accounts");
    	$table->addColumn("recovery_key", "string")
		    ->addColumn("realname", "string")
		    ->addColumn("location", "string")
		    ->addColumn("last_login", "datetime")
		    ->addColumn("admin_website", "boolean")
		    ->addColumn("ip", "string")
		    ->save();
    }
}
