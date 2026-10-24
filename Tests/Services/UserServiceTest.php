<?php 
declare(strict_types=1);

namespace Test\Services;

use Tests\TestCase;
use App\Services\UserService;
use App\Services\PasswordHasher;

class UserServiceTest extends TestCase {

    protected $userService;
    protected $userData;

    function setUp() : void {
        parent::setUp();    
        $this->userService = new UserService();
        $this->userData = [
            "firstName" => "Joao",
            "lastName" => "Silva",
            "email" => "joao.silva@gmail.com",
            "password" => "password123!",
        ];
    }

    public function test_consegue_criar_um_usuario(): void 
    {
        $user = $this->userService->createUser($this->userData);
        
        $this->assertNotNull($user);
        $this->assertSame($this->userData["email"], $user->email);
        $this->assertNotSame($this->userData['password'], $user->password_hash);
    }
    
    public function test_consegue_achar_usuario_pelo_id() : void 
    {
        $user = $this->userService->createUser($this->userData);
        


    }

}