<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    use HasFactory;
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
