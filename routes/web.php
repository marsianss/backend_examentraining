<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\InstructorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VehicleController::class, 'home'])->name('home');
Route::get('/voertuig/{id}/edit', [VehicleController::class, 'editVehicle'])->name('vehicle.edit');
Route::post('/voertuig/{id}/update', [VehicleController::class, 'updateVehicle'])->name('vehicle.update');
Route::get('/voertuiggegevens', [VehicleController::class, 'vehicleOverview'])->name('vehicle.overview');

// Redirect old route to new route for compatibility
Route::get('/instructeur/{id}/voertuigen', function($id) {
    return redirect()->route('instructors.vehicles', $id);
});

Route::get('/instructeurs', [InstructorController::class, 'index'])->name('instructors.index');
Route::get('/instructeurs/{id}/voertuigen', [InstructorController::class, 'showVehicles'])->name('instructors.vehicles');
Route::get('/instructeurs/{id}/beschikbare-voertuigen', [InstructorController::class, 'availableVehicles'])->name('instructors.available-vehicles');
Route::post('/instructeurs/{instructorId}/voertuig/{vehicleId}/toewijzen', [InstructorController::class, 'assignVehicle'])->name('instructors.assign-vehicle');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
