<?php

declare(strict_types=1);

namespace Tests\Models;

use Tests\TestCase;
use App\Models\Professor;


class ProfessorTest extends TestCase
{

    protected $data;

    public function setUp(): void
    {
        parent::setUp();
        $this->data = [
            "firstName" => "Maria",
            "lastName" => "Luiza",
            "email" => "maria.mota@gmail.com",
            "password" => "123123213asd!",
            "specialization" => "Geography",
            "value" => "12",
        ];
    }

    public function test_se_consegue_criar_o_professor(): void
    {
        $professor = Professor::create($this->data);
        $this->assertNotEmpty($professor);
        $this->assertInstanceOf(Professor::class, $professor);
    }

    public function test_se_professor_cria_de_maneira_correta(): void
    {
        $professor = Professor::create($this->data);
        $professor->refresh();
        $this->assertEquals("Maria", $professor->firstName);
        $this->assertEquals("Luiza", $professor->lastName);
        $this->assertEquals("maria.mota@gmail.com", $professor->email);
    }

    public function test_se_a_senha_tem_hash(): void
    {
        $professor = Professor::create($this->data);
        $professor->refresh();
        $this->assertTrue(password_verify($this->data["password"], $professor->password));
    }

    public function test_se_consegue_atualizar_dados_do_professor(): void {
        $professor = Professor::create($this->data);
        $professor->refresh();
        $this->assertEquals("Maria", $professor->firstName);
        $this->assertEquals("Luiza", $professor->lastName);
        $this->assertEquals("maria.mota@gmail.com", $professor->email);
        // TODO: Falta atualizar os dados do usuario para testar    
    }
}
