<?php


namespace App\Controllers;


class AuthController
{

  public function __construct() {}

  public function login(): void
  {
    view('login', []);
  }

  public function signin(): void
  {
    view('signin', []);
  }

  public function authenticateUser(): void
  {
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
      die('Tentativa de ataque detectada');
    }
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $errors = [];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "E-mail inválido.";
    }

    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      header('Location: /login');
      exit;
    }
  }

  public function createUser($data): void
  {
    view('signin', [$data]);
  }
}
