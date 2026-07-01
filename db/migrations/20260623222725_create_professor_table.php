<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProfessorTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table(
            "professors",
            [
                "id" => false,       // desativa o id autoincremento padrão
                "primary_key" => "id",
            ]
        );

        $table->addColumn("id", "integer", ["signed" => false]) // vai ser FK e PK ao mesmo tempo
            ->addTimestamps()
            ->addColumn("specialization", "string")
            ->addColumn("value", "decimal", ["precision" => 10, "scale" => 2])
            ->addColumn("status", "string", ["default" => "ativo"])
            ->addColumn('is_admin', 'boolean', ['default' => false])
            ->addForeignKey("id", "users", "id", [
                "delete" => "CASCADE",
                "update" => "CASCADE",
            ])
            ->create();
    }
}