<?php

namespace App\Http\Livewire\Dashboard\Graphics;

use App\Models\Cataport;
use App\Models\Estacion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ComprasEstacion extends Component
{
    public $monthInput,$labels=[],$data=[],$groups=[],$dataGroups=[];
    public function mount(){
        $this->monthInput=Carbon::now()->format('Y-m');
        $this->consulta();
        $this->emit('updateChartCompra');
    }
    public function consulta(){
        $this->labels=[];
        $this->groups=[];
        $this->dataGroups=[];
        $month=Carbon::create($this->monthInput);
        $rango=[$month->startOfMonth()->toDateTimeString(),$month->endOfMonth()->toDateTimeString()];
        $result=Estacion::whereHas('viajes',function(Builder $cataportes)use($rango){
            $cataportes->whereBetween('created_at',$rango);
        })->orderBy('id','ASC')->get();
        $this->labels=$result->pluck('name');
        foreach($result as $estacion){
            $data=[];
            $totalGral=Cataport::where('estacion_id',$estacion->id)->whereBetween('created_at',$rango)->sum('contenido');
            $totalIndividual=Cataport::selectRaw('combustible_id,SUM(contenido) as total')->groupBy('combustible_id')->where('estacion_id',$estacion->id)->whereBetween('created_at',$rango)->get();
            foreach($totalIndividual as $ind){
                array_push($data,[$ind->combustible->tipo,$ind->total]);
            }
            array_push($this->groups,['value'=>$totalGral,'groupId'=>$estacion->name]);
            array_push($this->dataGroups,['dataGroupId'=>$estacion->name,'data'=>$data]);
        }
        //dd($this->labels,$this->dataGroups);
    }
    public function updateData(){
        $this->consulta();
        $this->emit('updateChartCompra');
    }
    public function render()
    {
        return view('livewire.dashboard.graphics.compras-estacion');
    }
}
