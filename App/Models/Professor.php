<?php 
declare(strict_types=1);

namespace App\Models; 
use App\Models\User; 
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;

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