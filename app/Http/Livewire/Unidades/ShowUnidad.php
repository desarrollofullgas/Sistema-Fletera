<?php

namespace App\Http\Livewire\Unidades;

use App\Models\Unidad;
use Livewire\Component;

class ShowUnidad extends Component
{
    public $unidadID,$unidad;
    public function mount(){
        $this->unidad = Unidad::find($this->unidadID);
    }
    public function render()
    {
        return view('livewire.unidades.show-unidad');
    }
}
