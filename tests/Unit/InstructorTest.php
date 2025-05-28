<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Instructor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InstructorTest extends TestCase
{
    use RefreshDatabase;

    public function test_instructor_can_be_created()
    {
        $instructor = new Instructor([
            'Voornaam' => 'John',
            'Achternaam' => 'Doe',
            'Mobiel' => '0612345678',
            'DatumInDienst' => '2023-01-01',
            'AantalSterren' => 4,
            'IsActief' => true
        ]);

        $this->assertEquals('John', $instructor->Voornaam);
        $this->assertEquals('Doe', $instructor->Achternaam);
        $this->assertEquals(4, $instructor->AantalSterren);
        $this->assertTrue($instructor->IsActief);
    }

    public function test_instructor_stars_range()
    {
        $instructor = new Instructor([
            'Voornaam' => 'Jane',
            'Achternaam' => 'Doe',
            'Mobiel' => '0612345678',
            'DatumInDienst' => '2023-01-01',
            'AantalSterren' => 5,
            'IsActief' => true
        ]);

        $this->assertGreaterThanOrEqual(1, $instructor->AantalSterren);
        $this->assertLessThanOrEqual(5, $instructor->AantalSterren);
    }
}
