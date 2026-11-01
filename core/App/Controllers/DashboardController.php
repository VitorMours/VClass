<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Services\AuthService;


class DashboardController {

    // public function __construct(private readonly AuthService $authService) {}
    public function __construct() {}

    public function index() : void {

        view('dashboard/index');    
    }
}
?>