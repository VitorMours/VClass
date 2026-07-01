<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StudentStatus;


/**
 * Modelo da entidade de Student, esta vinculado diretamente a classse @see User
 * 
 * @property string $registration_number Seu numero de matricula
 * @property int $grade Qual ano escolar o estudante se encontra
 * @property \DateTime $enrolled_at Data de matricula do estudante
 * 
 * as propriedades herdadas de @see User são:
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property StudentStatus $status
 * 
 */
class Student extends User
{

    /**
     * Retorna os campos que podem ser preenchidos em massa
     * combina os campos herdados de @see User com os campos especificos, sendo eles
     * 
     * @property string $registration_number 
     * @property int $grade 
     * 
     * @return array
     */
    public function getFillable()
    {
        return array_merge(parent::getFillable(), ['registration_number', 'grade']);
    }

    public function getCasts()
    {
        return array_merge(parent::getCasts(), ['enrolled_at' => 'datetime']);
    }
    
}
