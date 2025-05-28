<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleType;
use App\Models\Vehicle;
use App\Models\Instructor;

class TestDatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create a test vehicle type
        $vehicleType = VehicleType::create([
            'TypeVoertuig' => 'Auto',
            'Rijbewijscategorie' => 'B',
            'IsActief' => true
        ]);

        // Create a test instructor
        $instructor = Instructor::create([
            'Voornaam' => 'John',
            'Achternaam' => 'Doe',
            'Mobiel' => '0612345678',
            'DatumInDienst' => '2023-01-01',
            'AantalSterren' => 4,
            'IsActief' => true
        ]);

        // Create a test vehicle
        $vehicle = Vehicle::create([
            'Type' => 'Car',
            'Kenteken' => 'ABC-123',
            'Bouwjaar' => '2020-01-01',
            'Brandstof' => 'Petrol',
            'TypeVoertuigId' => $vehicleType->id,
            'IsActief' => true
        ]);

        // Attach the vehicle to the instructor
        $vehicle->instructors()->attach($instructor->id, [
            'DatumToekenning' => now(),
            'IsActief' => true
        ]);
    }
}
