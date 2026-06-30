<?php

namespace Tests;

use App\Core\EloquentBootstrap;
use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Inicializa o Eloquent em Memória
        EloquentBootstrap::init(true);
        // Cria as tabelas necessárias antes de cada teste
        $this->migrate();
    }

    protected function migrate()
    {
        $schema = Capsule::schema();
        if (!$schema->hasTable('users')) {
            $schema->create('users', function ($table) {
                $table->increments('id');
                $table->string('firstName');
                $table->string('lastName');
                $table->string('email');
                $table->string('password');
                $table->string('status')->default('ativo'); // ADICIONE ESTA LINHA
                $table->timestamps();
            });
        }
        
        if (!$schema->hasTable('professors')) {
            $schema->create('professors', function ($table) {
                $table->increments('id');
                $table->string('firstName');
                $table->string('lastName');
                $table->string('email');
                $table->string('password');
                $table->string('specialization');
                $table->float('value');
                $table->string('status')->default('ativo');
                $table->timestamps();
            });
        }
    }
}
