<?php 
declare(strict_types=1);

namespace Test\Models;
use Tests\TestCase;

use App\Models\Professor;
use App\Models\Student;
use App\Models\Class_;

class ClassTest extends TestCase {

    protected $classData;
    protected $studentData;
    protected $professorData;

    function setUp() : void {
        parent::setUp();    
        $this->professorData = [
            "firstName" => "Maria",
            "lastName" => "Luiza",
            "email" => "maria.mota@gmail.com",
            "password" => "123123213asd!",
            "specialization" => "Geography",
            "value" => "12",
        ];
        $this->studentData = [
            "firstName" => "Joao",
            "lastName" => "Silva",
            "email" => "joao.silva@gmail.com",
            "password" => "password123!",
        ];
        $this->classData = [
            "name" => "Data Structures",
            "start_time" => "08:00:00",
            "end_time" => "08:30:00",
            "code" => "DSA101",
        ];
    }

    public function test_consegue_criar_uma_turma(): void {
        $professor = Professor::create($this->professorData);    
        $class = Class_::create([...$this->classData, "professor_id" => $professor->id]);
        $created_class = Class_::find(1);
        $this->assertEquals("1", $created_class->professor_id);
    }

    public function test_consegue_adicionar_um_aluno_na_turma(): void {
        $professor = Professor::create($this->professorData);
        $class = Class_::create([...$this->classData, "professor_id" => $professor->id]);
        $student = Student::create($this->studentData);
        $this->assertEquals(0, $class->students()->count());
        $class->students()->attach($student->id);
        $this->assertEquals(1, $class->students()->count());
    }

}