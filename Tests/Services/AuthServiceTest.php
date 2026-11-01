<?php
declare(strict_types=1);

namespace Tests\Services;

use Tests\TestCase;
use App\Services\AuthService;
use App\Services\PasswordHasher;
use App\Services\StudentService;
use App\Services\UserService;
use App\Services\ProfessorService;

class AuthServiceTest extends TestCase {

    protected $authService;

    function setUp(): void {
        parent::setUp();
        $passwordHasher = new PasswordHasher();
        $this->authService = new AuthService($passwordHasher, new UserService());
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
    }

    public function test_authenticate_with_valid_credentials_returns_user(): void {
        $password = 'senha-teste123';
        $userService = new UserService();
        $user = $userService->createUser([
            'firstName' => 'Teste',
            'lastName' => 'Homologacao',
            'email' => 'auth.valid@example.com',
            'password' => $password,
        ]);

        $authenticatedUser = $this->authService->authenticateWithCredentials(
            'auth.valid@example.com',
            $password
        );

        $this->assertNotNull($authenticatedUser);
        $this->assertSame($user->getKey(), $authenticatedUser->getKey());
    }

    public function test_authenticate_with_invalid_password_returns_null(): void {
        $userService = new UserService();
        $userService->createUser([
            'firstName' => 'Teste',
            'lastName' => 'Homologacao',
            'email' => 'auth.invalid@example.com',
            'password' => 'senha-correta123',
        ]);

        $authenticatedUser = $this->authService->authenticateWithCredentials(
            'auth.invalid@example.com',
            'senha-incorreta123'
        );

        $this->assertNull($authenticatedUser);

    }
}
?>