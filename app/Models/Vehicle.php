<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vehicle extends Model
{
    protected $table = 'voertuig';

    protected $fillable = [
        'Kenteken',
        'Type',
        'Bouwjaar',
        'Brandstof',
        'TypeVoertuigId',
        'IsActief',
        'Opmerking'
    ];

    public $timestamps = false;

    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(Instructor::class, 'voertuig_instructeur', 'VoertuigId', 'InstructeurId')
            ->withPivot(['DatumToekenning', 'IsActief', 'Opmerking'])
            ->withTimestamps('DatumAangemaakt', 'DatumGewijzigd');
    }

    public function typeVoertuig()
    {
        return $this->belongsTo(VehicleType::class, 'TypeVoertuigId');
    }
}
