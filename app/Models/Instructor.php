<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Instructor extends Model
{
    protected $table = 'instructeur';

    protected $fillable = [
        'Voornaam',
        'Tussenvoegsel',
        'Achternaam',
        'Mobiel',
        'DatumInDienst',
        'AantalSterren',
        'IsActief',
        'Opmerking'
    ];

    public $timestamps = false;

    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class, 'voertuig_instructeur', 'InstructeurId', 'VoertuigId')
            ->withPivot(['DatumToekenning', 'IsActief', 'Opmerking'])
            ->withTimestamps('DatumAangemaakt', 'DatumGewijzigd');
    }
}
