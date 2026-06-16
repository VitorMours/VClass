<?php


namespace App\Controllers;


class AuthController {

  public function __construct() {}

  public function login(): void {
    view('login', []);
  } 

  public function signin(): void {
    view('signin', []);
  }

  public function authenticateUser(): void {}  

  public function createUser($data): void {
    view('signin', [$data]);
  }  
}
?>