<?php

namespace App\Http\Livewire\Viajes;

use App\Models\Cataport;
use App\Models\Unidad;
use Livewire\Component;

class ChangeStatus extends Component
{
    public $viajeID,$status;
    public function mount(){
        $this->status=Cataport::find($this->viajeID)->status;
    }
    public function descarga(){
        $viaje=Cataport::find($this->viajeID);
        $viaje->status="Descargando";
        $viaje->save();
        $unidad=Unidad::find($viaje->unidad_id);
        $unidad->status="En descarga";
        $unidad->save();
        session()->flash('flash.banner', 'El viaje a sido marcado como "Descargando".');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(request()->header('Referer'));
    }
    public function end(){
        $viaje=Cataport::find($this->viajeID);
        $viaje->status="Finalizado";
        $viaje->save();
        session()->flash('flash.banner', 'El viaje a sido finalizado.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        return view('livewire.viajes.change-status');
    }
}
