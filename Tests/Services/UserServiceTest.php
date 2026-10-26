<?php 
declare(strict_types=1);

namespace Test\Services;

use Tests\TestCase;
use App\Services\UserService;
use App\Services\PasswordHasher;
use App\Services\AuthService;

class UserServiceTest extends TestCase {

    protected $userService;
    protected $userData;

    function setUp() : void {
        parent::setUp();    
        $this->userService = new UserService(new AuthService(new PasswordHasher()));
        $this->userData = [
            "firstName" => "Joao",
            "lastName" => "Silva",
            "email" => "joao.silva@gmail.com",
            "password" => "password123!",
        ];
    }


    public function test_create_User_method_exists() : void 
    {
        $this->assertTrue(method_exists(UserService::class,'createUser')); 
    }

    public function test_find_user_by_id_method_exists() : void 
    {
        $this->assertTrue(method_exists(UserService::class, 'findUserById'));
    }

    public function test_find_user_by_email_method_exists() : void 
    {
        $this->assertTrue(method_exists(UserService::class, 'findUserByEmail'));
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
        $result = $this->userService->findUserById((string) $user->id);

        $this->assertNotNull($result);
        $this->assertSame($user->id, $result->id);
    }

    public function test_consegue_achar_usuario_pelo_email() : void
    {
        $user = $this->userService->createUser($this->userData);
        $result = $this->userService->findUserByEmail($this->userData['email']);

        $this->assertNotNull($result);
        $this->assertSame($user->id, $result->id);
        $this->assertSame($this->userData['email'], $result->email);
    }



    


}