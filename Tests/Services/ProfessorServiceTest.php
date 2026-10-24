<?php 
declare(strict_types=1);

namespace Tests\Services;

use Tests\TestCase;
use App\Services\ProfessorService;

class ProfessorServiceTest extends TestCase {

    function setUp(): void {
        parent::setUp();
    }

    public function test_se_create_professor_service_method_existe() : void {
        $this->assertTrue(method_exists(ProfessorService::class, 'createProfessor'));
    }
}
?>