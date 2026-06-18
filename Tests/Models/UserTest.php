<?php 

namespace Tests\Models;

use PHPUnit\Framework\TestCase;
use App\Models\User;


class UserTest extends TestCase {

    public function test_if_can_create_user_instance() {
        $calculadora = new Calculadora();
        $resultado = $calculadora->somar(2, 3);

        // Verifica se o resultado é igual a 5
        $this->assertEquals(5, $resultado);
    }

}
?>