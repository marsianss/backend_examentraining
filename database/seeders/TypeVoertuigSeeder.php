<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeVoertuigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_voertuig')->insert([
            ['Id' => 1, 'TypeVoertuig' => 'Personenauto', 'Rijbewijscategorie' => 'B'],
            ['Id' => 2, 'TypeVoertuig' => 'Vrachtwagen', 'Rijbewijscategorie' => 'C'],
            ['Id' => 3, 'TypeVoertuig' => 'Bus', 'Rijbewijscategorie' => 'D'],
            ['Id' => 4, 'TypeVoertuig' => 'Bromfiets', 'Rijbewijscategorie' => 'AM'],
        ]);
    }
}
