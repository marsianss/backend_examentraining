<?php

namespace App\Http\Controllers;

use App\Models\Instructeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    public function index()
    {
        // Gebruik stored procedure voor het ophalen van instructeurs gesorteerd op sterren
        $instructors = DB::select('CALL sp_GetInstructeursSortedByStars()');
        return view('instructors.index', compact('instructors'));
    }

    public function showVehicles($id)
    {
        $instructor = Instructeur::findOrFail($id);
        // Gebruik stored procedure voor het ophalen van voertuigen voor deze instructeur
        $vehicles = DB::select('CALL sp_GetVehiclesByInstructor(?)', [$id]);

        return view('instructors.vehicles', compact('instructor', 'vehicles'));
    }

    public function availableVehicles($id)
    {
        $instructor = Instructeur::findOrFail($id);
        // Gebruik stored procedure voor het ophalen van beschikbare voertuigen
        $availableVehicles = DB::select('CALL sp_GetAvailableVehicles()');

        return view('instructors.available_vehicles', compact('instructor', 'availableVehicles'));
    }

    public function assignVehicle($instructorId, $vehicleId)
    {
        $instructor = Instructeur::findOrFail($instructorId);
        $vehicle = \App\Models\Voertuig::findOrFail($vehicleId);

        // Gebruik stored procedure voor het toewijzen van een voertuig
        DB::statement('CALL sp_AssignVehicleToInstructor(?, ?)', [
            $vehicleId,
            $instructorId
        ]);

        return redirect()->route('instructors.vehicles', $instructorId)
            ->with('success', 'Voertuig succesvol toegewezen aan instructeur.');
    }
}
