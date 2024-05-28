<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidad extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='unidades';
    public function scopeSearch($query, $value)
    {
        $query->where(function ($query) use ($value) {
            $query->where('id', 'like', "%{$value}%")
                ->orWhere('tractor', 'like', "%{$value}%")
                ->orWhere('capacidad', 'like', "%{$value}%")
                ->orWhere('placa', 'like', "%{$value}%")
                ->orWhere('marca', 'like', "%{$value}%")
                ->orWhere('modelo', 'like', "%{$value}%")
                ->orWhere('serie', 'like', "%{$value}%")
                ->orWhere('status', 'like', "%{$value}%")
                ->orWhere('created_at', 'like', "%{$value}%");
        })->orWhere(function ($query) use ($value) {
            $query->whereIn('linea_id', function ($subquery) use ($value) {
                $subquery->select('id')
                    ->from('lineas')
                    ->where('name', 'LIKE', "%{$value}%");
            });
        });
    }

    public function toneles():HasMany
    {
        return $this->hasMany(Pipa::class,'unidad_id');
    }
    public function linea():BelongsTo
    {
        return $this->belongsTo(Linea::class);
    }
}
