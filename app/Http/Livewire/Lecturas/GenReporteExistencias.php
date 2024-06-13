<?php

namespace App\Http\Livewire\Lecturas;

use App\Exports\Reportes\ExistenciasExport;
use App\Models\Estacion;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class GenReporteExistencias extends Component
{
    public $estaciones,$estacion,$tipo,$start,$end;
    public function mount(){
        $this->estaciones=Estacion::with('lecturas')->orderBy('name', 'ASC')->get(['id','name']);
    }
    public function genReporte(){
        $this->validate([
            'start'=> ['required'],
            'end'=> ['required']
        ],[
            'start.required'=> 'Ingrese la fecha de inicio.',
            'end.required'=> 'Ingrese la fecha final.'
        ]);
        try{
            $rango=[Carbon::create($this->start)->startOfDay()->toDateTimeString(),Carbon::create($this->end)->endOfDay()->toDateTimeString()];
            if($this->tipo=='general'){
                $estaciones=Estacion::whereHas('lecturas',function(Builder $lecturas)use($rango){
                    $lecturas->whereBetween('created_at',$rango);
                })->pluck('id');
            }else{
                $estaciones=[$this->estacion];
            }
            return Excel::download(new ExistenciasExport($estaciones,$rango),'Reporte de existencias.xlsx');
        }
        catch(Exception $error){
            dd($error);
            session()->flash('flash.banner', 'Ha ocurrido un error al generar el reporte, favor de contactar a un administrador');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect(request()->header('Referer'));
        }
    }
    public function render()
    {
        return view('livewire.lecturas.gen-reporte-existencias');
    }
}