<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecepcionPipa extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function scopeSearch(Builder $query,$txt):void
    {
        $query->where('cataporte_id','LIKE','%'.$txt.'%')
        ->orWhereHas('cataporte',function(Builder $carta)use($txt){
            $carta->whereHas('estacion',function(Builder $est)use($txt){
                $est->where('name','LIKE','%'.$txt.'%');
            });
        });
    }
    public function cataporte():BelongsTo
    {
        return $this->belongsTo(Cataport::class,'cataporte_id');
    }
}
