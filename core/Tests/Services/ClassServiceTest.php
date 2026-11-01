<?php
declare(strict_types=1);

namespace Tests\Services;

use App\Services\ClassService;

use Tests\TestCase;

class ClassServiceTest extends TestCase {

    function setUp() : void {
        parent::setUp();
    }

    public function test_se_existe_metodo_de_criar_classe() : void {
        $this->assertTrue(method_exists(ClassService::class, 'createClass')); 
    }
}
?>