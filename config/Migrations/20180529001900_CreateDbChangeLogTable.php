<?php
use Migrations\AbstractMigration;

class CreateDbChangeLogTable extends AbstractMigration
{
    public function change()
    {
    	$table = $this->table("db_changelog");
	    $table->addColumn("model", "string")
		    ->addColumn("foreign_key", "integer")
		    ->addColumn("field", "string")
		    ->addColumn("old", "text", ["null" => true])
		    ->addColumn("new", "text", ["null" => true])
		    ->addColumn("account_id", "integer", ["null" => true])
		    ->addForeignKey("account_id", "accounts", "id")
		    ->addColumn("created", "datetime")
		    ->save();
    }
}
