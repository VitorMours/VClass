<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
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
  public function logout() : void {
    $this->verifyCsrfToken();

    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
      $params = session_get_cookie_params();

      setcookie(session_name(), '', [
        'expires' => time() - 42000,
        'path' => $params['path'],
        'domain' => $params['domain'],
        'secure' => $params['secure'],
        'httponly' => $params['httponly'],
        'samesite' => $params['samesite'] ?? 'Lax',
      ]);
    }

    session_destroy();
    header('Location: /');
    die;
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

    $user = $this->authService->authenticateWithCredentials($email, $password);
    if (!($user instanceof User)) {
      $_SESSION['errors'] = ['auth' => 'E-mail ou senha inválidos.'];
      header('Location: /login');
      exit;
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = $user->getKey();
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $user = $this->userService->findUserById((string) $user->getKey());
    view('dashboard/index', ['user' => $user]);
    exit;
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
      $return = $this->userService->createUser($userData);// preencher com os dados de usuario
      session_regenerate_id(true);
      $_SESSION['user_id'] = $return->getKey();
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
      header('Location: /dashboard');
      exit;

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
