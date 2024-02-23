<?php

namespace App\Http\Livewire\Proveedores;

use App\Models\Proveedor;
use Livewire\Component;

class ProveedorShow extends Component
{
    public $proveedorID,$proveedor;
    public function mount(){
        $this->proveedor = Proveedor::find($this->proveedorID);
    }
    public function render()
    {
        return view('livewire.proveedores.proveedor-show');
    }
}
