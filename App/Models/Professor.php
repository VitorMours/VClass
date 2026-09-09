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


    /**
     * Pega os campos que podem ser preenchidos em massa pela entidade que 
     * é extendida, e adiciona os campos específicos do usuário para que sejam 
     * adicionados também na criação da entidade em passa, sendo eles:
     * 
     * @property string $specialization Área de especialização do Docente
     * @property float $value O valor por hora/aula que o mesmo é pago
     * 
     * @return array
     */
    #[\Override]
    public function getFillable() : array {
        return array_merge(parent::getFillable(), ['specialization', 'value']);
    }


    /**
     * Campos que devem ser convertidos para tipos específicos durante a 
     * definição da entidade dentro do sistema, sendo os tipos, outras entidades
     * presentes dentro do sistema
     */
    #[\Override]
    public function getCasts() : array {
        return array_merge(
            parent::getCasts()
        );
    } 



    public function classes() : HasMany {
        return $this->hasMany(Class_::class, 'professor_id', 'id');
    }

    /**
     * Campos que devem ser modificados durante a criação da entidade dentro 
     * do banco de dados, de forma a garantir que eles sejam preenchidos 
     * da maneira correta
     * 
     * @property UserStatus $status Definição de usuário como ativo, 
     * possibilitando o uso da plataforma
     */
    #[\Override]
    protected static function booted () {
        static::created(function ($user) {
            $user->status = $user->status ?? UserStatus::ATIVO;
        });
    }     
}
?>