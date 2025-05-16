<?php

namespace App\Http\Controllers;

use App\Models\Voertuig;
use App\Models\Instructeur;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function home()
    {
        $instructors = Instructeur::all();
        return view('home', compact('instructors'));
    }

    public function vehiclesByInstructor($id)
    {
        $instructor = Instructeur::findOrFail($id);
        $instructors = Instructeur::all();
        $vehicles = $instructor->vehicles()->orderBy('Rijbewijscategorie')->get();
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

        // For vehicles that are already assigned, only allow updating certain fields
        if ($vehicle->voertuigInstructeurs()->exists()) {
            $vehicle->update($request->only(['Type', 'Brandstof', 'Kenteken']));

            // Get the current instructor assignment
            $voertuigInstructeur = $vehicle->voertuigInstructeurs()->first();
            $currentInstructorId = $voertuigInstructeur->InstructeurId;

            // Check if the instructor has been changed
            if ($request->has('instructor_id') && $request->instructor_id && $request->instructor_id != $currentInstructorId) {
                // Get instructor names for the message
                $oldInstructor = Instructeur::find($currentInstructorId);
                $newInstructor = Instructeur::find($request->instructor_id);

                // Update assignment to new instructor
                $voertuigInstructeur->update([
                    'InstructeurId' => $request->instructor_id,
                    'DatumToekenning' => now()->format('Y-m-d'),
                ]);

                // Create success message with instructor names
                $successMessage = "Voertuig {$vehicle->Kenteken} ({$vehicle->Type}) is opnieuw toegewezen van {$oldInstructor->Voornaam} {$oldInstructor->Achternaam} naar {$newInstructor->Voornaam} {$newInstructor->Achternaam}";

                // Redirect to the new instructor's vehicle page
                return redirect()->route('instructors.vehicles', $request->instructor_id)
                    ->with('success', $successMessage);
            }

            // If instructor hasn't changed, redirect to the current instructor's vehicle page
            return redirect()->route('instructors.vehicles', $currentInstructorId)
                ->with('success', "Voertuiggegevens voor {$vehicle->Kenteken} zijn bijgewerkt.");
        } else {
            // For unassigned vehicles, allow updating all fields including Bouwjaar
            $vehicle->update($request->only(['Type', 'Brandstof', 'Kenteken', 'Bouwjaar']));

            // If an instructor ID is provided, assign the vehicle to that instructor
            if ($request->has('instructor_id') && $request->instructor_id) {
                // Get the instructor name for the message
                $instructor = Instructeur::find($request->instructor_id);

                \App\Models\VoertuigInstructeur::create([
                    'VoertuigId' => $vehicle->id,
                    'InstructeurId' => $request->instructor_id,
                    'DatumToekenning' => now()->format('Y-m-d'),
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
        $instructors = Instructeur::all();
        return view('vehicle_overview', compact('instructors'));
    }
}
