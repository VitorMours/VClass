<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateClassTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table("classes");
        $table->addTimestamps()
            ->addColumn("name", "string")
            ->addColumn("code", "string")
            ->addColumn("start_time", "datetime")
            ->addColumn("end_time", "datetime")
            ->addColumn("professor_id", "integer")
            ->addColumn("class_id", "integer")
            ->addForeignKey("professor_id", "professors", "id", [
                "delete" => "SET NULL",
                "update" => "CASCADE"
            ])
            ->create();
    }
}
