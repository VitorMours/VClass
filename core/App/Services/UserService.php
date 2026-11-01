<?php 
declare(strict_types=1);

namespace App\Services;
use App\Models\User;

class UserService {
    public function createUser(array $userData): User
    {
        return User::create($userData);
    }
    
    public function findUserById(string $userID): ?User
    {
        return User::find($userID);

    }

    public function findUserByEmail(string $email)  
    {
        return User::where('email', $email)->first();
    }

    public function updateUser(): void {}
    public function deleteUser(): void {}
}

?>