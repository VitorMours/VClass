<?php 
declare(strict_types=1);

namespace Test\Services;

use Tests\TestCase;
use App\Services\UserService;
use App\Services\PasswordHasher;

class UserServiceTest extends TestCase {

    protected $userService;

    function setUp() : void {
        parent::setUp();    
        $passwordHasher = new PasswordHasher();
        $this->userService = new UserService($passwordHasher);
    }

    public function test_consegue_criar_um_usuario(): void {
        $userData = [
            "firstName" => "Joao",
            "lastName" => "Silva",
            "email" => "joao.silva@gmail.com",
            "password" => "password123!",
        ];
        $user = $this->userService->createUser($userData);
        
        $this->assertNotNull($user);
        $this->assertSame($userData["email"], $user->email);
    }

}