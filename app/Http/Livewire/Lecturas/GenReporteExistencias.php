<?php

namespace App\Http\Livewire\Lecturas;

use App\Exports\Reportes\ExistenciasExport;
use App\Models\Estacion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class GenReporteExistencias extends Component
{
    public $estaciones,$estacion,$tipo,$start,$end;
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
        if($this->tipo=='general'){
            $estaciones=Estacion::whereHas('combustibles',function(Builder $combustibles)use($rango){
                $combustibles->whereHas('detalleLectura',function(Builder $detalle)use($rango){
                    $detalle->whereBetween('created_at',$rango);
                });
            })->pluck('id');
        }else{
            $estaciones=[$this->estacion];
        }
        return Excel::download(new ExistenciasExport($estaciones,$rango),'Reporte de existencias.xlsx');

    }
    public function render()
    {
        return view('livewire.lecturas.gen-reporte-existencias');
    }
}
