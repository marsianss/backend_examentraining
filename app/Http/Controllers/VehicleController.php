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

    public function editVehicle($id)
    {
        $vehicle = Voertuig::findOrFail($id);
        
        // Check if vehicle is already assigned to any instructor
        $isAssigned = $vehicle->voertuigInstructeurs()->exists();
        
        return view('edit_vehicle', compact('vehicle', 'isAssigned'));
    }

    public function updateVehicle(Request $request, $id)
    {
        $vehicle = Voertuig::findOrFail($id);
        
        // For vehicles that are already assigned, only allow updating certain fields
        if ($vehicle->voertuigInstructeurs()->exists()) {
            $vehicle->update($request->only(['Type', 'Brandstof', 'Kenteken']));
            // Get the instructor ID from the first assignment
            $instructeurId = $vehicle->voertuigInstructeurs()->first()->InstructeurId;
            return redirect()->route('instructors.vehicles', $instructeurId)
                ->with('success', 'Voertuiggegevens bijgewerkt.');
        } else {
            // For unassigned vehicles, allow updating all fields including Bouwjaar
            $vehicle->update($request->only(['Type', 'Brandstof', 'Kenteken', 'Bouwjaar']));
            
            // If this is part of an assignment flow, redirect to the instructor's page
            if ($request->has('instructorId')) {
                return redirect()->route('instructors.available-vehicles', $request->instructorId)
                    ->with('success', 'Voertuiggegevens bijgewerkt.');
            }
            
            // Otherwise redirect to vehicle overview
            return redirect()->route('vehicle.overview')
                ->with('success', 'Voertuiggegevens bijgewerkt.');
        }
    }

    public function vehicleOverview()
    {
        $instructors = Instructeur::all();
        return view('vehicle_overview', compact('instructors'));
    }
}
