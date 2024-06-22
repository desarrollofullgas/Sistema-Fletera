<?php

namespace App\Http\Livewire\Recepcion;

use App\Models\RecepcionPipa;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RecepcionTable extends Component
{
    use WithPagination;
    public $valid,$search="",$start,$end;
    //Propiedad computada Recepciones
    public function getRecepcionesProperty(){
        return RecepcionPipa::search($this->search)
        ->when(Auth::user()->permiso_id==3,function($query){//cuando el usuario sea gerente
            $query->whereHas('cataporte',function(Builder $carta){
                $carta->where('estacion_id',Auth::user()->estacion->id);
            });
        })
        ->when($this->start && $this->end,function($query){//si hay fecha de inicio y fin
            $rango=[Carbon::create($this->start)->startOfDay()->toDateTimeString(),Carbon::create($this->end)->endOfDay()->toDateTimeString()];
            return $query->whereBetween('created_at',$rango);
        })->orderBy('id','DESC')->paginate(15);
    }
    public function render()
    {
        $this->valid=Auth::user()->permiso->panels->where('id',14)->first();
        return view('livewire.recepcion.recepcion-table');
    }
}
