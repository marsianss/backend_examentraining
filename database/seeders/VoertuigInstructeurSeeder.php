<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoertuigInstructeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('voertuig_instructeur')->insert([
            ['Id' => 1, 'VoertuigId' => 1, 'InstructeurId' => 5, 'DatumToekenning' => '2017-06-18'],
            ['Id' => 2, 'VoertuigId' => 3, 'InstructeurId' => 1, 'DatumToekenning' => '2021-09-26'],
            ['Id' => 3, 'VoertuigId' => 9, 'InstructeurId' => 1, 'DatumToekenning' => '2021-09-27'],
            ['Id' => 4, 'VoertuigId' => 4, 'InstructeurId' => 4, 'DatumToekenning' => '2022-08-01'],
            ['Id' => 5, 'VoertuigId' => 5, 'InstructeurId' => 1, 'DatumToekenning' => '2019-08-30'],
            ['Id' => 6, 'VoertuigId' => 10, 'InstructeurId' => 5, 'DatumToekenning' => '2020-02-02'],
        ]);
    }
}
