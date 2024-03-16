<?php

namespace App\Http\Livewire\Lecturas;

use App\Models\Estacion;
use App\Models\Lectura;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class GenReporteVentas extends Component
{
    public $estaciones,$estacion,$tipoVent,$start,$end;
    public function mount(){
        $this->estaciones=Estacion::orderBy('name', 'ASC')->get(['id','name']);
    }
    public function genReporte(){
        $this->validate([
            'start'=> ['required'],
            'end'=> ['required']
        ],[
            'start.required'=> 'Ingrese la fecha de inicio.',
            'end.required'=> 'Ingrese la fecha final.'
        ]);
        $rango=[Carbon::create($this->start)->startOfDay()->toDateTimeString(),Carbon::create($this->end)->endOfDay()->toDateTimeString()];
        if($this->tipoVent=='general'){
            $data=Lectura::whereBetween('created_at',$rango)->orderBy('id','DESC')->get();
        }else{
            $data=Lectura::whereHas('detalles',function(Builder $detalles){
                $detalles->whereHas('combustible',function(Builder $combustible){
                    $combustible->where('estacion_id',$this->estacion);
                });
            })->whereBetween('created_at',$rango)->orderBy('id','DESC')->get();
            dd($data);
        }
    }
    public function render()
    {
        return view('livewire.lecturas.gen-reporte-ventas');
    }
}
