<?php

namespace App\Http\Controllers;

use App\Models\Instructeur;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        // Get instructors sorted by 'AantalSterren' in descending order
        $instructors = Instructeur::orderBy('AantalSterren', 'desc')->get();
        return view('instructors.index', compact('instructors'));
    }

    public function showVehicles($id)
    {
        $instructor = Instructeur::findOrFail($id);
        $vehicles = $instructor->vehicles()->get();

        return view('instructors.vehicles', compact('instructor', 'vehicles'));
    }

    public function availableVehicles($id)
    {
        $instructor = Instructeur::findOrFail($id);

        // Get all vehicle IDs already assigned to any instructor
        $assignedVehicleIds = \App\Models\VoertuigInstructeur::pluck('VoertuigId')->toArray();

        // Get vehicles that are not assigned to any instructor
        $availableVehicles = \App\Models\Voertuig::whereNotIn('id', $assignedVehicleIds)
            ->orderBy('TypeVoertuigId')
            ->get();

        return view('instructors.available_vehicles', compact('instructor', 'availableVehicles'));
    }

    public function assignVehicle($instructorId, $vehicleId)
    {
        $instructor = Instructeur::findOrFail($instructorId);
        $vehicle = \App\Models\Voertuig::findOrFail($vehicleId);

        // Create new assignment
        \App\Models\VoertuigInstructeur::create([
            'VoertuigId' => $vehicleId,
            'InstructeurId' => $instructorId,
            'DatumToekenning' => now()->format('Y-m-d'),
        ]);

        return redirect()->route('instructors.vehicles', $instructorId)
            ->with('success', 'Voertuig succesvol toegewezen aan instructeur.');
    }
}
