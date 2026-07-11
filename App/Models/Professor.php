<?php 
declare(strict_types=1);

namespace App\Models; 
use App\Models\User; 
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * Modelo de entidade de Professor, esta vinculado diretamente a classe @see User
 * 
 * @property string $specialization Area de especializacao do professor
 * @property float $value Valor cobrado pelo professor por hora de aula
 * 
 * as propriedades herdadas de @see User são:
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property StudentStatus $status
 */
class Professor extends User {
    

    public function getFillable() : array {
        return array_merge(parent::getFillable(), ['specialization', 'value']);
    }

    public function getCasts() : array {
        return array_merge(parent::getCasts());
    } 

    public function classes() : HasMany {
        return $this->hasMany(Class_::class, 'professor_id', 'id');
    }

    protected static function booted () {
        static::created(function ($user) {
            $user->status = $user->status ?? UserStatus::ATIVO;
        });
    }     
}
?>