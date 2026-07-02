<?php

declare(strict_types=1);

namespace Test\Models;

use App\Models\Student;
use App\Models\User;
use App\Enums\UserStatus;
use Tests\TestCase;


class StudentTest extends TestCase
{

  protected $studentData;

  function setUp(): void
  {
    parent::setUp();
    $this->studentData = [
      "firstName" => "Joao",
      "lastName" => "Silva",
      "email" => "joao.silva@gmail.com",
      "password" => "password123!",
    ];
  }

  function test_consegue_criar_um_aluno(): void {
    $student = Student::create($this->studentData);
    $created_student = Student::find(1);
    $this->assertEquals('joao.silva@gmail.com', $created_student->email);
    $this->assertEquals('Joao', $created_student->firstName);
  }

  function test_consegue_atualizar_um_aluno(): void {
    $student = Student::create($this->studentData);

    $original_student = Student::find($student->id);
    $student->update([
        "firstName" => "Joao Pedro",
        "lastName" => "Silva Santos",
        "email" => "teste@teste.com",
    ]);

    $updated_student = Student::find($student->id);

    $this->assertNotEquals($original_student->firstName, $updated_student->firstName);
    $this->assertNotEquals($original_student->lastName, $updated_student->lastName);
    $this->assertNotEquals($original_student->email, $updated_student->email);

    // e também confirma que os valores batem com o esperado
    $this->assertEquals("Joao Pedro", $updated_student->firstName);
    $this->assertEquals("Silva Santos", $updated_student->lastName);
    $this->assertEquals("teste@teste.com", $updated_student->email);
  }

  function test_consegue_deletar_um_aluno(): void {
    $student = Student::create($this->studentData);
    $created_student = Student::find(1);
    $this->assertNotNull($created_student);
    $student->delete();
    $deleted_student = Student::find(1);
    $this->assertNull($deleted_student);
  }

  function test_consegue_atribuir_valores_de_registro_e_grade() : void {
    $student = Student::create($this->studentData);
    $student->update(["registration_number" => "123asd", "grade" => "23" ]);
    $this->assertEquals("123asd", $student->registration_number);
    $this->assertIsInt($student->grade);
    $this->assertEquals(23, $student->grade);
  }

  function test_consegue_atribuir_valor_de_data_de_matricula() : void {
    $student = Student::create($this->studentData);
    $student->update(['enrolled_at' => '2023-01-01 00:00:00']);
    $student->refresh();
    $this->assertInstanceOf(\DateTimeInterface::class, $student->enrolled_at);
  }

  function test_consegue_atribuir_valor_de_status() : void {
    $student = Student::create($this->studentData);
    $student->refresh();
    $this->assertInstanceOf(UserStatus::class, $student->status);
    $this->assertEquals(UserStatus::ATIVO, $student->status);
    $student->update(["status" => UserStatus::SUSPENSO]);
    $student->refresh();
    $this->assertEquals(UserStatus::SUSPENSO, $student->status);
  }

}
