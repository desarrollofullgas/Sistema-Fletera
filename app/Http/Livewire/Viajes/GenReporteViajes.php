<?php

namespace App\Http\Livewire\Viajes;

use App\Exports\Reportes\ViajesExport;
use App\Models\Cataport;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class GenReporteViajes extends Component
{
    public $start,$end;
    public function genReporte(){
        $rango=[Carbon::create($this->start)->startOfDay()->toDateTimeString(),Carbon::create($this->end)->endOfDay()->toDateTimeString()];
        $data=Cataport::whereBetween('created_at',$rango)->get();
        return Excel::download(new ViajesExport($data),'Reporte de viajes.xlsx');
    }
    public function render()
    {
        return view('livewire.viajes.gen-reporte-viajes');
    }
}
