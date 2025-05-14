<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voertuig extends Model
{
    protected $table = 'voertuig';
    public $timestamps = false;

    protected $fillable = [
        'Kenteken',
        'Type',
        'Bouwjaar',
        'Brandstof',
        'TypeVoertuigId',
        'IsActief',
        'Opmerking',
    ];

    public function typeVoertuig(): BelongsTo
    {
        return $this->belongsTo(TypeVoertuig::class, 'TypeVoertuigId');
    }

    public function voertuigInstructeurs(): HasMany
    {
        return $this->hasMany(VoertuigInstructeur::class, 'VoertuigId');
    }
}
