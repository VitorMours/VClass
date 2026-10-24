<?php
declare(strict_types=1);

namespace Tests\Services;

use Tests\TestCase;
use App\Services\AuthService;
use App\Services\PasswordHasher;
use App\Services\StudentService;
use App\Services\ProfessorService;

class AuthServiceTest extends TestCase {

    protected $authService;

    function setUp(): void {
        parent::setUp();
        $this->authService = new AuthService(new PasswordHasher(), new StudentService(), new ProfessorService());
    }

    public function test_existe_methodo_secure_password() : void {
        $this->assertTrue(method_exists(AuthService::class, 'securePassword'));        
    }

    public function test_metodo_secure_password_faz_hash_da_senha() : void {
        $password = 'senha-teste123';
        $hashedPassword = $this->authService->securePassword($password);

        $this->assertNotSame($password, $hashedPassword);
    }

    public function test_existe_methodo_authenticate_with_credentials() : void {
        $this->assertTrue(method_exists(AuthService::class, 'authenticateWithCredentials'));
    }

    public function test_authenticate_with_credentials_method() : void {
        $email = 'teste.homologacao@email.com';
        $password = 'senha-teste123';
        $hashedPassword = $this->authService->securePassword($password);
        $this->assertNotSame($password, $hashedPassword);
        // Verificar se os dados de credenciais sao autenticados corretamente

    }
}
?>