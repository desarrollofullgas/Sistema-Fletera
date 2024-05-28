<?php

namespace App\Http\Livewire\Unidades;

use App\Models\Unidad;
use Livewire\Component;

class DeleteUnidad extends Component
{
    public $unidadID,$name;
    public function mount(){
        $unidad=Unidad::find($this->unidadID);
        $this->name=$unidad->tractor;
    }
    public function deleteUnidad(){
        $unidad=Unidad::find($this->unidadID)->delete();
        session()->flash('flash.banner', 'Una unidad de transporte ha sido eliminada permanentemente.');
        session()->flash('flash.bannerStyle', 'success');
        //volvemos a la direccion que tiene el navegador
        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        return view('livewire.unidades.delete-unidad');
    }
}
