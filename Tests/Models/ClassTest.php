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
        $this->classData = [];
    }

    // function test_se_consegue_criar_a_classe() : void {
    //     $professor = Professor::create($this->professorData);
    //     $student = Student::create($this->studentData);
    //     $this->assertinstanceOf(Professor::class, $professor);
    //     $this->assertinstanceOf(Student::class, $student);
        
    //     $class = Class_::create($this->classData);

    // }
}
?>