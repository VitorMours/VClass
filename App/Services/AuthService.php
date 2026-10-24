<?php 
declare(strict_types=1);

namespace App\Services;


/**
 * Servico de Autenticacao e Autorizacao
 * 
 * Servico focado na autenticacao e na autorizacao do usuario
 * dentro da sessao e do app, de forma a facilitar o acesso
 * e de forma a garantir que os acessos sejam feitos de forma 
 * devida e organizada
 */
class AuthService {

    public function __construct(
        private readonly PasswordHasher $passwordHasher,
        private readonly StudentService $studentService,
        private readonly ProfessorService $professorService,
        ){}
    
    public function securePassword(string $password) : string {
        return $this->passwordHasher->hashPassword($password);
    }

    /**
     * Metodo para autenticar usuarios dentro do sistema
     *  @param string   email Email do usuario que esta sendo autenticado
     *  @param string   password Senha do usuario que esta sendo autenticado
     *  @return bool result Retorna se o usuario foi autenticado com sucesso, ou sem sucesso
     */
    public function authenticateWithCredentials(string $email, string $password) : bool {




    }
}
?>