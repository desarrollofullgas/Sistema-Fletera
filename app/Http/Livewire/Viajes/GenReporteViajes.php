<?php

namespace App\Http\Livewire\Viajes;

use App\Exports\Reportes\ViajesExport;
use App\Models\Cataport;
use Carbon\Carbon;
use Exception;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class GenReporteViajes extends Component
{
    public $start,$end;
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
            $data=Cataport::whereBetween('created_at',$rango)->get();
            return Excel::download(new ViajesExport($data),'Reporte de viajes.xlsx');
        }catch(Exception $error){
            session()->flash('flash.banner', 'Ha ocurrido un error al generar el reporte, favor de contactar a un administrador');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect(request()->header('Referer'));
        }
    }
    public function render()
    {
        return view('livewire.viajes.gen-reporte-viajes');
    }
}
