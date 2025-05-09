<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeVoertuig extends Model
{
    protected $table = 'type_voertuig';

    protected $fillable = [
        'TypeVoertuig',
        'Rijbewijscategorie',
        'IsActief',
        'Opmerking',
    ];

    public function voertuigen(): HasMany
    {
        return $this->hasMany(Voertuig::class, 'TypeVoertuigId');
    }
}
