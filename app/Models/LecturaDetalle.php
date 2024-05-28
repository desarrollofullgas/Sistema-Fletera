<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LecturaDetalle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['lectura_id', 'combustible_id', 'veeder', 'fisico', 'venta_periferico', 'venta_electronica', 'venta_odometro'];

    public function scopeSearch($query, $value)
    {
        return $query->where(function ($query) use ($value) {
            $query->where('id', 'like', "%{$value}%")
                ->orWhere('veeder', 'like', "%{$value}%")
                ->orWhere('fisico', 'like', "%{$value}%")
                ->orWhere('venta_periferico', 'like', "%{$value}%")
                ->orWhere('venta_electronica', 'like', "%{$value}%")
                ->orWhere('venta_odometro', 'like', "%{$value}%");
        })->orWhere(function ($query) use ($value) {
            $query->whereIn('lectura_id', function ($subquery) use ($value) {
                $subquery->select('id')
                    ->from('lecturas')
                    ->where('total_litros', 'LIKE', "%{$value}%");
            });
        })->orWhere(function ($query) use ($value) {
            $query->whereIn('combustible_id', function ($subquery) use ($value) {
                $subquery->select('id')
                    ->from('combustibles')
                    ->where('tipo', 'LIKE', "%{$value}%");
            });
        })->orWhereHas('combustible.info.estacion', function ($query) use ($value) {
            $query->where('name', 'LIKE', "%{$value}%");
        })
        /* ->orWhereHas('combustible.estacion', function ($query) use ($value) {
            $query->where('name', 'LIKE', "%{$value}%");
        }) */;
    }

    public function lectura():BelongsTo
    {
        return $this->belongsTo(Lectura::class);
    }
    public function combustible()
    {
        return $this->belongsTo(Combustible::class);
    }
}
