<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoertuigInstructeur extends Model
{
    protected $table = 'voertuig_instructeur';
    public $timestamps = false; // Disable Laravel's automatic timestamp handling

    protected $fillable = [
        'VoertuigId',
        'InstructeurId',
        'DatumToekenning',
        'IsActief',
        'Opmerking',
    ];

    public function voertuig(): BelongsTo
    {
        return $this->belongsTo(Voertuig::class, 'VoertuigId');
    }

    public function instructeur(): BelongsTo
    {
        return $this->belongsTo(Instructeur::class, 'InstructeurId');
    }
}
