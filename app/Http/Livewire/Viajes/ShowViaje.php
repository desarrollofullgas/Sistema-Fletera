<?php

namespace App\Http\Livewire\Viajes;

use App\Models\Cataport;
use Livewire\Component;

class ShowViaje extends Component
{
    public $viajeID,$viaje;
    public function mount(){
        $this->viaje=Cataport::find($this->viajeID);
    }
    public function render()
    {
        return view('livewire.viajes.show-viaje');
    }
}
