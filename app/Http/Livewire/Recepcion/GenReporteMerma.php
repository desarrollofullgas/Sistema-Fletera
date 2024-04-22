<?php

namespace App\Http\Livewire\Recepcion;

use App\Exports\Reportes\MermasExport;
use App\Models\Estacion;
use App\Models\RecepcionPipa;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class GenReporteMerma extends Component
{
    public $tipo,$estaciones,$estacion,$start,$end;
    public function mount(){
        $this->estaciones=Estacion::orderBy('name','ASC')->get(['id','name']);
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
                $data=RecepcionPipa::whereBetween('created_at',$rango)->get();
            }else{
                $this->validate([
                    'estacion'=> ['required']
                ],[
                    'estacion.required'=> 'Seleccione una estación.',
                ]);
                $data=RecepcionPipa::whereHas('cataporte',function(Builder $viajes){
                    $viajes->where('estacion_id',$this->estacion);
                })->whereBetween('created_at',$rango)->get();
            }
            return Excel::download(new MermasExport($data),'Reporte_mermas.xlsx');
        }catch(Exception $error){
            session()->flash('flash.banner','Ha ocurrido un error al generar el reporte, favor de contactar a un administrador');
            session()->flash('flash.bannerStyle','danger');
            return redirect(request()->header('Referer'));
        }
        
    }
    public function render()
    {
        return view('livewire.recepcion.gen-reporte-merma');
    }
}
