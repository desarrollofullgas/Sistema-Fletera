<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Linea extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function scopeSearch($query, $value){
        $query->where('id', 'like', "%{$value}%")
        ->orWhere('name', 'like', "%{$value}%")
        ->orWhere('clave', 'like', "%{$value}%")
        ->orWhere('rfc', 'like', "%{$value}%")
        ->orWhere('created_at', 'like', "%{$value}%");
    }
    //mutadores y accesores
    protected function Name():Attribute
    {
        return Attribute::make(
            //mutador para que se convierta a mayuscula
            set: fn(string $val) => mb_strtoupper($val)
        );
    }
    protected function Clave():Attribute
    {
        return Attribute::make(
            //mutador para que se convierta a mayuscula
            set: fn(string $val) => mb_strtoupper($val)
        );
    }
    protected function Rfc():Attribute
    {
        return Attribute::make(
            //mutador para que se convierta a mayuscula
            set: fn(string $val) => mb_strtoupper($val)
        );
    }
    //----------fin mutadores y accesores
}
