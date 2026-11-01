<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateClassStudentTable extends AbstractMigration
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
        // 1. Criamos a tabela sem o ID automático ('id' => false)
        $table = $this->table('class_student', [
            'id' => false,
            'primary_key' => ['class_id', 'student_id']
        ]);

        // 2. Adicionamos as colunas que servirão de chaves estrangeiras
        $table->addColumn('class_id', 'integer')
            ->addColumn('student_id', 'integer')

            // 3. Adicionamos as restrições de chave estrangeira
            ->addForeignKey('class_id', 'classes', 'id', [
                'delete' => 'CASCADE', // Se a turma for deletada, o vínculo também é
                'update' => 'CASCADE'
            ])
            ->addForeignKey('student_id', 'students', 'user_id', [
                'delete' => 'CASCADE', // Se o aluno for deletado, o vínculo também é
                'update' => 'CASCADE'
            ])
            ->create();
    }
}
