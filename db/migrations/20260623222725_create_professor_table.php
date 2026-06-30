<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProfessorTable extends AbstractMigration
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
        $table = $this->table(
            "professors",
            [
                "id" => false,
                "primary_key" => "user_id"
            ]
        );

        $table->addTimestamps()
            ->addColumn("firstName", "string")
            ->addColumn("lastName", "string")
            ->addColumn("email", "string")
            ->addColumn("password", "string")
            ->addColumn("status", "string", ["default" => "ativo"])
            ->addColumn('is_admin', 'boolean', ['default' => false])
            ->addIndex(["email"], ['unique' => true])
            ->create();
    }
}
