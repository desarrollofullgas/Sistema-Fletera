<?php

namespace App\Http\Livewire\Lecturas;

use App\Models\Lectura;
use App\Models\LecturaDetalle;
use Livewire\Component;

class ShowLectura extends Component
{
    public $lecturaID,$lectura,$datos;
    public function mount(){
        $this->lectura=LecturaDetalle::find($this->lecturaID);
    }
    public function render()
    {
        return view('livewire.lecturas.show-lectura');
    }
}
