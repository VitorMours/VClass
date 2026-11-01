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
        if (!$schema->hasTable('students')) {
            $schema->create('students', function ($table) {
                $table->increments('id');
                $table->string('firstName');
                $table->string('lastName');
                $table->string('email');
                $table->string('password');
                $table->string('registration_number')->nullable();
                $table->string('grade')->nullable();
                $table->string('status')->default('ativo');
                $table->timestamp('enrolled_at')->nullable();
                $table->timestamps();
            });
        }

        if (!$schema->hasTable('class_')) {
            $schema->create('class_', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->time('start_time');
                $table->time('end_time');
                $table->string('code');
                $table->unsignedInteger('professor_id');
                $table->foreign('professor_id')->references('id')->on('professors')->onDelete('cascade');
                $table->timestamps();
            });
        }
        if (!$schema->hasTable('class_student')) {
            $schema->create('class_student', function ($table) {
                $table->unsignedInteger('class_id');
                $table->unsignedInteger('student_id');
                $table->foreign('class_id')->references('id')->on('class_')->onDelete('cascade');
                $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
                $table->primary(['class_id', 'student_id']);
            });
        }
        if (!$schema->hasTable('schools')) {
            $schema->create('schools', function ($table) {
                $table->increments('id');
                $table->string('owner');
                $table->string('location');
                $table->string('name');
                $table->string('cnpj');
                $table->timestamps();
            });
        }
    }
}
