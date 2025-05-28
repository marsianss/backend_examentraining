<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_vehicle_can_be_created()
    {
        $vehicle = new Vehicle([
            'Type' => 'Car',
            'Kenteken' => 'ABC-123',
            'Bouwjaar' => '2020-01-01',
            'Brandstof' => 'Petrol',
            'TypeVoertuigId' => 1,
            'IsActief' => true
        ]);

        $this->assertEquals('Car', $vehicle->Type);
        $this->assertEquals('ABC-123', $vehicle->Kenteken);
        $this->assertEquals('2020-01-01', $vehicle->Bouwjaar);
        $this->assertEquals('Petrol', $vehicle->Brandstof);
        $this->assertTrue($vehicle->IsActief);
    }

    public function test_vehicle_kenteken_format()
    {
        $vehicle = new Vehicle([
            'Type' => 'Car',
            'Kenteken' => 'ABC-123',
            'Bouwjaar' => '2020-01-01',
            'Brandstof' => 'Petrol',
            'TypeVoertuigId' => 1,
            'IsActief' => true
        ]);

        $this->assertMatchesRegularExpression('/^[A-Z]{3}-[0-9]{3}$/', $vehicle->Kenteken);
    }
}
