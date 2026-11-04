<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Services\AuthService;


class DashboardController {

    // public function __construct(private readonly AuthService $authService) {}
    public function __construct() {}

    public function index() : void {
        // TODO: Preciso adicionar as metricas de dashboard aqui, como numero de alunos, numero de turmas, etc.
        view('dashboard/index');    
        die;
    }

    public function alunos() : void {
        view('dashboard/alunos');
        die;
    }
}
?>