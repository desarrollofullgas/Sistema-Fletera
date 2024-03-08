<?php

namespace App\Http\Livewire\Recepcion;

use App\Models\Estacion;
use App\Models\RecepcionPipa;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class GenReporteMerma extends Component
{
    public $tipo,$estaciones,$estacion,$start,$end;
    public function mount(){
        $this->estaciones=Estacion::orderBy('name','ASC')->get(['id','name']);
    }
    public function genReporte(){
        $rango=[Carbon::create($this->start)->startOfDay()->toDateTimeString(),Carbon::create($this->end)->endOfDay()->toDateTimeString()];
        if($this->tipo=='general'){
            $data=RecepcionPipa::whereBetween('created_at',$rango)->get();
        }else{
            $data=RecepcionPipa::whereHas('cataporte',function(Builder $viajes){
                $viajes->where('estacion_id',$this->estacion);
            })->whereBetween('created_at',$rango)->get();
            dd($data,$rango,$this->estacion);
        }
    }
    public function render()
    {
        return view('livewire.recepcion.gen-reporte-merma');
    }
}
