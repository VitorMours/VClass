<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;


class AuthController
{

  public function __construct() {}

  public function login(): void
  {
    view('login');
  }

  public function signin(): void
  {
    view('signin');
  }

  public function authenticateUser(): void {
    $errors = [];

    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
      die('Tentativa de ataque detectada');
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "E-mail inválido.";
    }
    if(empty($password) || strlen($password) <= 6){
      $errors["password"] = "Senha em formato invalido.";      
    }
    
    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      header('Location: /login');
      exit;
    }

    try{
      
    }catch(\Exception $e){

    }

  }

  public function createUser(): void
  {
  }
}
