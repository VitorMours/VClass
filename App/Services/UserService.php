<?php 
declare(strict_types=1);

namespace App\Services;
use App\Models\User;
use App\Services\AuthService;

class UserService {
    public function __construct() {}

    public function createUser(array $userData): User
    {
        try {
            $newPassword = AuthService::hashPassword($userData['password']);
            $userData = [...$userData, 'password' => $newPassword];        
            return User::create($userData);
        } catch(\Exception $e) {
            throw $e;
        }
    }
    
    public function findUser(string $userID): ?User
    {
        return User::find($userID);

    }

    public function updateUser(): void {}
    public function deleteUser(): void {}
}

?>