<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zona extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function scopeSearch($query, $value){
        $query->where('id', 'like', "%{$value}%")
        ->orWhere('name', 'like', "%{$value}%")
        ->orWhere('status', 'like', "%{$value}%")
        ->orWhere('created_at', 'like', "%{$value}%");
    }
    public function getStatusColorAttribute(){
        return[
            'Activo' => 'green',
            'Inactivo' => 'red',
        ][$this->status] ?? 'gray';
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_zona');
    }
    public function estacions()
    {
        return $this->hasMany(Estacion::class);
    }
}
