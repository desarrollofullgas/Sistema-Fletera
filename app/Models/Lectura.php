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

    public function detalles():HasMany
    {
        return $this->hasMany(LecturaDetalle::class);
    }
}
