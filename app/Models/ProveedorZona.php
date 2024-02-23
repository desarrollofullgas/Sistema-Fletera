<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorZona extends Model
{
    use HasFactory;

    protected $table = 'proveedor_zonas';

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }
}
