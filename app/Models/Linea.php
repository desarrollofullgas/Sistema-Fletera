<?php

namespace App\Models;

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
}
