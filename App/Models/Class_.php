<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Professor;
use App\models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Class_ extends Model
{
    protected $table = "class_";
    protected $fillable = ["name", "start_time", "end_time", "code", "professor_id"];

    public function professor(): BelongsTo
    {
        return $this->belongsTo(Professor::class, "professor_id", "id");
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'class_student', 'class_id', 'student_id');
    }

    public function casts(): array
    {
        return [
            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
        ];
    }
}
