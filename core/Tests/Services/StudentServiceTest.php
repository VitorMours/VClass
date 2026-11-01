<?php 
declare(strict_types=1);

use Tests\TestCase;
use App\Services\StudentService;


class StudentServiceTest extends TestCase {

    function setUp() : void {
        parent::setUp();
    }

    function test_se_create_student_service_method_existe() : void {
        $this->assertTrue(method_exists(StudentService::class, 'createStudent'));
    }
}
?>