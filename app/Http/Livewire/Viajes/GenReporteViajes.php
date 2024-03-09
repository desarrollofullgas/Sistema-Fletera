<?php

namespace App\Http\Livewire\Viajes;

use App\Models\Cataport;
use Carbon\Carbon;
use Livewire\Component;

class GenReporteViajes extends Component
{
    public $start,$end;
    public function genReporte(){
        $rango=[Carbon::create($this->start)->startOfDay()->toDateTimeString(),Carbon::create($this->end)->endOfDay()->toDateTimeString()];
        $data=Cataport::whereBetween('created_at',$rango)->get();
        dd($data);
    }
    public function render()
    {
        return view('livewire.viajes.gen-reporte-viajes');
    }
}
