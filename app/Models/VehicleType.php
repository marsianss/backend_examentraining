<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    protected $table = 'type_voertuig';

    protected $fillable = [
        'TypeVoertuig',
        'Rijbewijscategorie',
        'IsActief',
        'Opmerking'
    ];

    public $timestamps = false;

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'TypeVoertuigId');
    }
}
