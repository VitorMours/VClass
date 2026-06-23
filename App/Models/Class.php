<?php 
declare(strict_types=1);

namespace App\Models;
use Illuminate\Database\Eloquent\Model; 


class Class_ extends Model {
    protected $fillable = ["name","start_time","end_time"];
    //public function professor() : void {
    //   return $this->belongsTo(Professor::class, "professor_id", "id")
    //}

}


?>