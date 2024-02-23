<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name','razon_social','direccion','rfc','busqueda','status'];

    public function scopeSearch($query, $value){
        $query->where('id', 'like', "%{$value}%")
        ->orWhere('name', 'like', "%{$value}%")
        ->orWhere('razon_social', 'like', "%{$value}%")
        ->orWhere('direccion', 'like', "%{$value}%")
        ->orWhere('rfc', 'like', "%{$value}%")
        ->orWhere('busqueda', 'like', "%{$value}%")
        ->orWhere('status', 'like', "%{$value}%")
        ->orWhere('created_at', 'like', "%{$value}%");
    }
    public function getStatusColorAttribute(){
        return[
            'Activo' => 'green',
            'Inactivo' => 'red',
        ][$this->status] ?? 'gray';
    }

    public function zonas()
    {
        return $this->belongsToMany(Zona::class, 'proveedor_zonas');
    }
}
