<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lectura extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['total_litros','total_pesos'];

    public function scopeSearch($query, $value)
    {
        return $query->where(function ($query) use ($value) {
            $query->where('id', 'like', "%{$value}%")
                ->orWhere('total_litros', 'like', "%{$value}%")
                ->orWhere('total_pesos', 'like', "%{$value}%");
        })->orWhereHas('estacion', function ($query) use ($value) {
            $query->where('name', 'LIKE', "%{$value}%");
        })
        ->orWhereHas('detalles.combustible', function ($query) use ($value) {
            $query->where('tipo', 'LIKE', "%{$value}%");
        });
    }
    public function detalles():HasMany
    {
        return $this->hasMany(LecturaDetalle::class);
    }
    public function estacion():BelongsTo
    {
        return $this->belongsTo(Estacion::class);
    }
}
