<?php

namespace App\Http\Livewire\Lecturas;

use App\Exports\Reportes\VentasExport;
use App\Models\Estacion;
use App\Models\Lectura;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class GenReporteVentas extends Component
{
    public $estaciones,$estacion,$tipoVent,$start,$end;
    public function mount(){
        $this->estaciones=Estacion::whereHas('combustibles',function(Builder $combustibles){
            $combustibles->whereHas('detalleLectura');
        })->orderBy('name', 'ASC')->get(['id','name']);
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
            if($this->tipoVent=='general'){
                $estaciones=Estacion::whereHas('combustibles',function(Builder $combustibles)use($rango){
                    $combustibles->whereHas('detalleLectura',function(Builder $detalle)use($rango){
                        $detalle->whereBetween('created_at',$rango);
                    });
                })->pluck('id');
            }else{
                $estaciones=[$this->estacion];
            }
            return Excel::download(new VentasExport($estaciones,$rango),'Reporte de ventas.xlsx');
        }catch(Exception $error){
            session()->flash('flash.banner', 'Ha ocurrido un error al generar el reporte, favor de contactar a un administrador');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect(request()->header('Referer'));
        }
        
    }
    public function render()
    {
        return view('livewire.lecturas.gen-reporte-ventas');
    }
}
