<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserTable extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('firstName', 'string', ['limit' => 100])
              ->addColumn('lastName', 'string', ['limit' => 100])
              ->addColumn('email', 'string', ['limit' => 150])
              ->addColumn('password', 'string', ['limit' => 255])
              ->addColumn('status', 'string', ['default' => 'ativo', 'limit' => 50])
              ->addColumn('is_admin', 'boolean', ['default' => false])
              ->addTimestamps() // Cria created_at e updated_at
              ->addIndex(['email'], ['unique' => true])
              ->create();
    }
}
