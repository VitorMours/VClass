<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\UserService;


class AuthController
{
  public function __construct(private readonly AuthService $authService, private readonly UserService $userService) {}

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

    $this->verifyCsrfToken();

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

    $this->authService->authenticateWithCredentials($email, $password);
  }

  public function createUser(): void
  {
    $errors = [];

    $this->verifyCsrfToken();

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    $name = filter_input(INPUT_POST, 'name');
    $surname = filter_input(INPUT_POST, 'surname');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "E-mail inválido.";
    }
    if(empty($password) || strlen($password) <= 6){
      $errors["password"] = "Senha em formato invalido.";      
    }
    if(empty($name)) {
      $errors["name"] = "Nome precisa ser preenchido";      
    }
    if(empty($surname)) {
      $errors["surname"] = "Sobrenome precisa ser preenchido";      
    }
    
    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      header('Location: /signin');
      exit;
    }

    try{
      $result = $this->userService->findUserByEmail($email);
      
      if($result){
        $errors["auth"] = "Usuario ja existe dentro do sistema";      
        $_SESSION['errors'] = $errors;
        header('Location: /signin');
        exit;
      }

      $userData = [
          'firstName' => $name,
          'lastName' => $surname,
          'email' => $email,
          'password' => $password,
      ];
      $result = $this->userService->createUser($userData);// preencher com os dados de usuario

    }catch(\PDOException){

    }

  }

  private function verifyCsrfToken(): void
  {
    $submittedToken = $_POST['csrf_token'] ?? null;
    $sessionToken = $_SESSION['csrf_token'] ?? null;

    if (
      !is_string($submittedToken)
      || !is_string($sessionToken)
      || !hash_equals($sessionToken, $submittedToken)
    ) {
      http_response_code(403);
      exit('Token CSRF inválido ou ausente. Recarregue a página e tente novamente.');
    }
  }
}
