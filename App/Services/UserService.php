<?php 
declare(strict_types=1);

namespace App\Services;
use App\Services\PasswordHasher;
use App\Models\User;


class UserService {
    public function __construct(private readonly PasswordHasher $passwordHasher) {}


    public function createUser(): void {}
    public function updateUser(): void {}
    public function findUser(): void {}
    public function deleteUser(): void {}
}

?>