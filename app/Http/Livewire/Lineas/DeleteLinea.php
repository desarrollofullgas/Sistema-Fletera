<?php

namespace App\Http\Livewire\Lineas;

use App\Models\Linea;
use Livewire\Component;

class DeleteLinea extends Component
{
    public $lineaID,$name;
    public function mount(){
        $linea=Linea::find($this->lineaID);
        $this->name=$linea->name;
    }
    public function deleteLinea(){
        Linea::find($this->lineaID)->delete();
        session()->flash('flash.banner', ' línea de transporte ha sido eliminada.');
        session()->flash('flash.bannerStyle', 'success');
        //volvemos a la direccion que tiene el navegador
        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        return view('livewire.lineas.delete-linea');
    }
}
