<?php
declare(strict_types=1);

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model{

  protected $fillable = ['firstName', 'lastName', 'email', 'password', 'status'];
  protected $hidden = ['password'];

  public function setPasswordAttribute(string $value)
  {
    $this->attributes['password'] = password_hash($value, PASSWORD_BCRYPT);
  }

  protected static function booted()
  {
    static::creating(function ($user) {
      if (empty($user->status)) {
        $user->status = 'ativo';
      }
    });
  }
}
