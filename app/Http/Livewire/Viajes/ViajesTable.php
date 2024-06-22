<?php

namespace App\Http\Livewire\Viajes;

use App\Models\Cataport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ViajesTable extends Component
{
    use WithPagination;
    public $valid,$search="",$start,$end;
    public function mount(){
        $this->valid=Auth::user()->permiso->panels->where('id',13)->first();//validamos las opciones en Viajes que tiene acceso el usuario
    }
    //propiedad computda viajes
    public function getViajesProperty(){
        return Cataport::search($this->search)
        ->when(Auth::user()->permiso_id==3,function($query){//cuando el usuario se gerente
            return $query->where('estacion_id',Auth::user()->estacion->id);
        })
        ->when($this->start && $this->end,function($query){//si hay fecha de inicio y fin
            $rango=[Carbon::create($this->start)->startOfDay()->toDateTimeString(),Carbon::create($this->end)->endOfDay()->toDateTimeString()];
            return $query->whereBetween('created_at',$rango);
        })->orderBy('id','DESC')->paginate(15);
    }
    public function render()
    {
        $this->valid=Auth::user()->permiso->panels->where('id',13)->first();//validamos las opciones en Viajes que tiene acceso el usuario
        return view('livewire.viajes.viajes-table');
    }
}
