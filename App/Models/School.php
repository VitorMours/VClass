<?php
declare(strict_types=1);

namespace App\Models;
use Illuminate\Database\Eloquent\Model; 

class School extends Model {

    protected $fillable = ["owner", "location", "name", "cnpj"];
}
?>  