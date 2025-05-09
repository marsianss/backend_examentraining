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
        return view('edit_vehicle', compact('vehicle'));
    }

    public function updateVehicle(Request $request, $id)
    {
        $vehicle = Voertuig::findOrFail($id);
        $vehicle->update($request->only(['Type', 'Brandstof', 'Kenteken']));
        $instructeurId = $vehicle->voertuigInstructeurs()->first()->InstructeurId;
        return redirect()->route('instructor.vehicles', $instructeurId)->with('success', 'Voertuiggegevens bijgewerkt.');
    }

    public function vehicleOverview()
    {
        $instructors = Instructeur::all();
        return view('vehicle_overview', compact('instructors'));
    }
}
