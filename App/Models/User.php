<?php
declare(strict_types=1);

namespace App\Models;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Model;

class User extends Model {

  protected $fillable = ['firstName', 'lastName', 'email', 'password', 'status'];
  protected $hidden = ['password'];

  protected $casts = ["status" => UserStatus::class];

  public function setPasswordAttribute(string $value)
  {
    $this->attributes['password'] = password_hash($value, PASSWORD_BCRYPT);
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
