<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateStudentTable extends AbstractMigration
{
    public function change(): void
{
    // Criamos a tabela sem o ID autoincrementado do Phinx, 
    // definindo o user_id como a chave primária
    $table = $this->table("students", [
        "id" => false, 
        "primary_key" => "user_id"
    ]);

    $table->addColumn("user_id", "integer", ["signed" => true]) 
          ->addColumn("registration_number", "string")
          ->addColumn("grade", "string")
          ->addColumn("enrolled_at", "datetime")
          // Adicionamos a foreign key explicitamente
          ->addForeignKey("user_id", "users", "id", [
              "delete" => "CASCADE", 
              "update" => "CASCADE"
          ])
          ->create();
}
}
