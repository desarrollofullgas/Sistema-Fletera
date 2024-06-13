<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Combustible extends Model
{
    use HasFactory;
    public function info() :HasMany
    {
        return $this->hasMany(EstacionCombustible::class);
    }
    public function estacion()
    {
        return $this->belongsTo(Estacion::class);
    }
    public function detalleLectura():HasMany
    {
        return $this->hasMany(LecturaDetalle::class);
    }
}