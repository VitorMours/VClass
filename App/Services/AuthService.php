<?php 
declare(strict_types=1);

namespace App\Services;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;


class AuthService {
    public function __construct(){}
    public function authenticateWithCredentials(){}

    public static function hashPassword(string $password) : string {
        return Hash::make($password);
    }

}
?>