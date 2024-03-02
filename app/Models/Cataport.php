<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cataport extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function estacion(): BelongsTo
    {
        return $this->belongsTo(Estacion::class);
    }
    public function combustible(): BelongsTo
    {
        return $this->belongsTo(Combustible::class);
    }
    public function operador(): BelongsTo
    {
        return $this->belongsTo(Operador::class);
    }
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function tonel():BelongsTo
    {
        return $this->belongsTo(Pipa::class,'pipa_id');
    }
    public function recepcion():HasOne
    {
        return $this->hasOne(RecepcionPipa::class,'cataporte_id');
    }
}
