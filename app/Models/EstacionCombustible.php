<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstacionCombustible extends Model
{
    use HasFactory;
    public function estacion():BelongsTo
    {
        return $this->belongsTo(Estacion::class,'estacion_id');
    }
    public function combustible():BelongsTo
    {
        return $this->belongsTo(Combustible::class);
    }
}