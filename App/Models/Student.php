<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class Student extends User
{

    public function getFillable()
    {
        return array_merge(parent::getFillable(), ['registration_number', 'grade']);
    }

    public function getCasts()
    {
        return array_merge(parent::getCasts(), ['enrolled_at' => 'datetime']);
    }
    
}
