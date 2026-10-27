<?php
namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
  public static function sendConfirmationAccountCreationEmail() {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = '://exemplo.com';     // Servidor SMTP
        $mail->SMTPAuth   = true;                   // Habilitar autenticação SMTP
        $mail->Username   = 'seu-email@exemplo.com';  // Usuário SMTP
        $mail->Password   = 'sua-senha';            // Senha SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Criptografia TLS ou SSL
        $mail->Port       = 587;                    // Porta SMTP (geralmente 587 ou 465)

        $mail->setFrom('seu-email@exemplo.com', 'Seu Nome');
        $mail->addAddress('destinatario@exemplo.com', 'Nome do Destinatário');

        $mail->isHTML(true);
        $mail->setLanguage('br');
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Seja Bem vindo ao VClass!';
        $mail->Body    = '<b>Olá!</b> Este é um e-mail em formato HTML.';
        $mail->AltBody = 'Olá! Este é um e-mail em texto plano para clientes de e-mail sem suporte a HTML.';

        $mail->send();
        echo 'A mensagem foi enviada com sucesso!';
    } catch (Exception $e) {
        echo "Não foi possível enviar a mensagem. Erro: {$mail->ErrorInfo}";
    }
  }
}


?>