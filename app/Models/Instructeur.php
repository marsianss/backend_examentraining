<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Instructeur extends Model
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
        'Opmerking',
    ];

    public function voertuigInstructeurs(): HasMany
    {
        return $this->hasMany(VoertuigInstructeur::class, 'InstructeurId');
    }

    public function vehicles(): HasManyThrough
    {
        return $this->hasManyThrough(Voertuig::class, VoertuigInstructeur::class, 'InstructeurId', 'Id', 'id', 'VoertuigId')
            ->join('type_voertuig', 'voertuig.TypeVoertuigId', '=', 'type_voertuig.Id')
            ->orderBy('type_voertuig.Rijbewijscategorie');
    }
}
