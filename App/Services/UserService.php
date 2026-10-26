<?php 
declare(strict_types=1);

namespace App\Services;
use App\Models\User;

class UserService {
    public function __construct(private readonly AuthService $authService) {}

    public function createUser(array $userData): User
    {
        try {
            $newPassword = $this->authService->securePassword($userData['password']);
            $userData = [...$userData, 'password' => $newPassword];        
            $user = User::create($userData);
            printf("$user");
            return $user;
        } catch(\Exception $e) {
            throw $e;
        }
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