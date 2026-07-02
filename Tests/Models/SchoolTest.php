<?php

declare(strict_types=1);

namespace Tests\Models;

use Tests\TestCase;
use App\Models\School;

class SchoolTest extends TestCase
{
    protected array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'owner' => 'Admin',
            'location' => 'Rua A, 123',
            'name' => 'Escola Tal',
            'cnpj' => '12.345.678/0001-99',
        ];
    }

    public function test_consegue_criar_escola(): void
    {
        $school = School::create($this->data);
        $this->assertNotNull($school->id);
        $this->assertEquals('Escola Tal', $school->name);
    }

    public function test_consegue_atualizar_escola(): void
    {
        $school = School::create($this->data);
        $school->update(['name' => 'Outra Escola']);
        $school = School::find($school->id);
        $this->assertEquals('Outra Escola', $school->name);
    }

    public function test_consegue_deletar_escola(): void
    {
        $school = School::create($this->data);
        $id = $school->id;
        $school->delete();
        $this->assertNull(School::find($id));
    }
}
