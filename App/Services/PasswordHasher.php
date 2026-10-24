<?php
declare(strict_types=1);

namespace App\Services;

class PasswordHasher {
    public function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_BCRYPT);
    }


    public function verify_password(string $hashed_password): void {}
}

?>