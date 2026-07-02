<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo da entidade de User, sendo a classe base para as demais entidades 
 * que podem ser utilizadas por usuarios dentro do sistema, sendo elas as 
 * entidades de @see Professor e @see Student, que herdam desta classe.
 * 
 * @property string $firstName Nome do usuario 
 * @property string $lastName Sobrenome do usuario
 * @property string $email Email de acesso e contato do usuario ao sistema
 * @property string $password Senha de acesso do usuario ao sistema
 * @property UserStatus $status Status do usuario, podendo ser ativo, desativo ou suspenso 
 */
class User extends Model
{

  /**
   * Campos do respectivo modelo, os quais possuem comportamentos distintos 
   * a depender do array o qual eles se encontram, sendo eles:  
   * @property array $fillable Que podem ser preenchidos em massa, como pelo metodo create() do Eloquent
   * @property array $hidden Que nao devem ser expostos em respostas de API
   * @property array $casts Que devem ser convertidos para tipos específicos durante a criacao, atualizacao, leitura e serializacao do modelo
   */
  protected $fillable = ['firstName', 'lastName', 'email', 'password', 'status'];
  protected $hidden = ['password'];

  protected $casts = ["status" => UserStatus::class];

  public function setPasswordAttribute(string $value)
  {
    $this->attributes['password'] = password_hash($value, PASSWORD_BCRYPT);
  }

  public function getCasts()
  {
    return array_merge(parent::getCasts(), [
      'status' => UserStatus::class,
    ]);
  }

  protected static function booted()
  {
    static::creating(function ($user) {
      if (empty($user->status)) {
        $user->status = $user->status ?? UserStatus::ATIVO;
      }
    });
  }
}
