<?php

namespace Tests\Models;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase {

    public function test_consegue_criar_usuario_dentro_do_banco_de_dados() {
        $dados = [
            "firstName" => "Joao",
            "lastName" => "Silva",
            "email" => "joao.silva@gmail.com",
            "password" => "password123!",
        ];

        User::create($dados);

        // Como não temos assertDatabaseHas do Laravel, validamos consultando o banco
        $user = User::where('email', 'joao.silva@gmail.com')->first();

        $this->assertNotNull($user, "O usuário não foi encontrado no banco.");
        $this->assertEquals('Joao', $user->firstName);
    }
    
}