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
    protected $fillable = ["name", "start_time", "end_time", "code"];

    public function professor(): BelongsTo
    {
        return $this->belongsTo(Professor::class, "professor_id", "id");
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'class_student', 'class_id', 'student_id');
    }
}
