<?php

namespace App\Http\Controllers;

use App\Models\Voertuig;
use App\Models\Instructeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function home()
    {
        // Gebruik stored procedure voor het ophalen van instructeurs
        $instructors = DB::select('CALL sp_GetInstructeursSortedByStars()');
        return view('home', compact('instructors'));
    }

    public function vehiclesByInstructor($id)
    {
        $instructor = Instructeur::findOrFail($id);
        // Gebruik stored procedure voor het ophalen van alle instructeurs
        $instructors = DB::select('CALL sp_GetInstructeursSortedByStars()');
        // Gebruik stored procedure voor het ophalen van voertuigen voor deze instructeur
        $vehicles = DB::select('CALL sp_GetVehiclesByInstructor(?)', [$id]);
        return view('vehicles_by_instructor', compact('instructor', 'instructors', 'vehicles'));
    }

    public function editVehicle($id, Request $request)
    {
        $vehicle = Voertuig::findOrFail($id);

        // Check if vehicle is already assigned to any instructor
        $isAssigned = $vehicle->voertuigInstructeurs()->exists();

        // Get the current instructor if assigned
        $currentInstructorId = null;
        if ($isAssigned) {
            $currentInstructorId = $vehicle->voertuigInstructeurs()->first()->InstructeurId;
        }

        // Get all instructors for the dropdown
        $instructors = Instructeur::orderBy('AantalSterren', 'desc')->get();

        // Check if this is a reassignment request
        $isReassigning = $request->has('reassign') && $request->reassign === 'true';

        return view('edit_vehicle', compact('vehicle', 'isAssigned', 'instructors', 'currentInstructorId', 'isReassigning'));
    }

    public function updateVehicle(Request $request, $id)
    {
        $vehicle = Voertuig::findOrFail($id);
        $isAssigned = $vehicle->voertuigInstructeurs()->exists();

        // Update voertuig gegevens via stored procedure
        DB::statement('CALL sp_UpdateVehicle(?, ?, ?, ?, ?, ?)', [
            $id,
            $request->Type,
            $request->Brandstof,
            $request->Kenteken,
            $request->Bouwjaar,
            $isAssigned
        ]);

        if ($isAssigned) {
            $currentInstructorId = $vehicle->voertuigInstructeurs()->first()->InstructeurId;

            // Check if instructor has changed
            if ($request->has('instructor_id') && $request->instructor_id && $request->instructor_id != $currentInstructorId) {
                // Get instructor names for the message
                $oldInstructor = Instructeur::find($currentInstructorId);
                $newInstructor = Instructeur::find($request->instructor_id);

                // Gebruik stored procedure voor het hertoewijzen van het voertuig
                DB::statement('CALL sp_ReassignVehicle(?, ?, ?)', [
                    $id,
                    $currentInstructorId,
                    $request->instructor_id
                ]);

                // Create success message with instructor names
                $successMessage = "Voertuig {$vehicle->Kenteken} ({$vehicle->Type}) is opnieuw toegewezen van {$oldInstructor->Voornaam} {$oldInstructor->Achternaam} naar {$newInstructor->Voornaam} {$newInstructor->Achternaam}";

                return redirect()->route('instructors.vehicles', $request->instructor_id)
                    ->with('success', $successMessage);
            }

            return redirect()->route('instructors.vehicles', $currentInstructorId)
                ->with('success', "Voertuiggegevens voor {$vehicle->Kenteken} zijn bijgewerkt.");
        } else {
            if ($request->has('instructor_id') && $request->instructor_id) {
                $instructor = Instructeur::find($request->instructor_id);

                // Gebruik stored procedure voor het toewijzen van het voertuig
                DB::statement('CALL sp_AssignVehicleToInstructor(?, ?)', [
                    $id,
                    $request->instructor_id
                ]);

                return redirect()->route('instructors.vehicles', $request->instructor_id)
                    ->with('success', "Voertuig {$vehicle->Kenteken} ({$vehicle->Type}) is toegewezen aan {$instructor->Voornaam} {$instructor->Achternaam}.");
            }

            // If this is part of an assignment flow, redirect to the instructor's page
            if ($request->has('instructorId')) {
                return redirect()->route('instructors.available-vehicles', $request->instructorId)
                    ->with('success', 'Voertuiggegevens bijgewerkt.');
            }

            // Otherwise redirect to vehicle overview
            return redirect()->route('vehicle.overview')
                ->with('success', "Voertuiggegevens voor {$vehicle->Kenteken} zijn bijgewerkt.");
        }
    }

    public function vehicleOverview()
    {
        // Get instructors with eager loading of their vehicles for the count badges
        $instructors = Instructeur::with('voertuigInstructeurs')->orderBy('AantalSterren', 'desc')->get();
        return view('vehicle_overview', compact('instructors'));
    }
}
