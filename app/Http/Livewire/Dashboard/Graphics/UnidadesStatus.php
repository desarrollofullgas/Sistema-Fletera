<?php

namespace App\Http\Livewire\Dashboard\Graphics;

use App\Models\Unidad;
use Carbon\Carbon;
use Livewire\Component;

class UnidadesStatus extends Component
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
        $result=Unidad::selectRaw('COUNT(id) as cant,status')->groupBy('status')->get();
        foreach($result as $unidad){
            array_push($this->data,['value'=>$unidad->cant,'name'=>$unidad->status]);
        }
    }
    public function render()
    {
        return view('livewire.dashboard.graphics.unidades-status');
    }
}
