<?php

declare(strict_types=1);

namespace Tests\Models;

use Tests\TestCase;
use App\Models\User;
use App\Enums\UserStatus;

class UserTest extends TestCase
{
    protected array $dados;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dados = [
            "firstName" => "Joao",
            "lastName" => "Silva",
            "email" => "joao.silva@gmail.com",
            "password" => "password123!",
        ];
    }

    public function test_consegue_criar_usuario_dentro_do_banco_de_dados()
    {
        User::create($this->dados);

        // Como não temos assertDatabaseHas do Laravel, validamos consultando o banco
        $user = User::where('email', 'joao.silva@gmail.com')->first();
        $this->assertNotNull($user, "O usuário não foi encontrado no banco.");
        $this->assertEquals('Joao', $user->firstName);
        $this->assertEquals('Silva', $user->lastName);
    }

    public function test_consegue_modificar_os_dados_do_usuario_criado(): void
    {
        $user = User::create($this->dados);
        $this->assertEquals("Joao", $user->firstName);
        $user = User::where('email', 'joao.silva@gmail.com')->first();
        $user->update([
            "email" => "lucas.damasceno@gmail.com",
            "firstName" => "Lucas"
        ]);
        $atualizado = User::find($user->id);
        $this->assertEquals("lucas.damasceno@gmail.com", $atualizado->email);
        $this->assertEquals("Lucas", $atualizado->firstName);
    }

    public function test_senha_nao_aparece_no_serializer(): void
    {
        $user = User::create($this->dados);
        $serialized_data = $user->toArray();
        $this->assertArrayNotHasKey('password', $serialized_data);
    }

    public function test_senha_sendo_hasheada_ao_ser_criada(): void
    {
        $user = User::create($this->dados);
        $this->assertEquals("password123!", $this->dados['password']);
        $this->assertNotEquals('password123!', $user->password);
        $this->assertTrue(password_verify($this->dados['password'], $user->password));
    }

    public function test_hash_especifico_cada_usuario(): void
    {
        $user1 = User::create($this->dados);
        $user2 = User::create([
            ...$this->dados,
            'email' => 'outro@gmail.com',
        ]);

        // bcrypt gera salt aleatório — hashes nunca iguais
        $this->assertNotEquals($user1->password, $user2->password);
    }

    public function test_criacao_campos_nao_especificados_dentro_do_dto(): void
    {
        $user1 = User::create($this->dados);
        $user2 = User::create([...$this->dados, "email" => "lucas.damasceno@gmail.com"]);
        $this->assertNotEquals($user1->password, $user2->password);
    }
    public function test_id_e_status_gerado_automaticamente() : void 
    {
        $user = User::create($this->dados);
        $user->refresh();
        $this->assertNotNull($user->id, "Id nao esta sendo gerado pelo banco");
        $this->assertNotNull($user->status, "Status esta nulo");
    } 
    public function test_status_padrao_seria_ativo() : void 
    {
        $user = User::create($this->dados);
            $user->refresh();
        $this->assertEquals(UserStatus::ATIVO, $user->status);
    }
}
