<?php

namespace App\Http\Livewire\Dashboard\Graphics;

use App\Models\Cataport;
use App\Models\Estacion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ViajesResumen extends Component
{
    public $monthInput,$labels=[],$data=[];
    public function mount(){
        $this->monthInput=Carbon::now()->format('Y-m');
        $this->consulta();
    }
    public function consulta(){
        $this->data=[];
        $month=Carbon::create($this->monthInput);
        $rango=[$month->startOfMonth()->toDateTimeString(),$month->endOfMonth()->toDateTimeString()];
        $result=Estacion::whereHas('viajes',function(Builder $cataportes)use($rango){
            $cataportes->whereBetween('created_at',$rango);
        })->orderBy('id','ASC')->get();
        $this->labels=$result->pluck('name');
        foreach($result as $estacion){
            array_push($this->data,$estacion->viajes->whereBetween('created_at',$rango)->count());
        }
        //dd($result,$rango,$this->data);
    }
    public function updateData(){
        //dd($this->monthInput);
        $this->consulta();
        $this->emit('updateChartViajes');
    }
    public function render()
    {
        return view('livewire.dashboard.graphics.viajes-resumen');
    }
}
