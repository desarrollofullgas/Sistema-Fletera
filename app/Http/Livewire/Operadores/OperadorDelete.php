<?php

namespace App\Http\Livewire\Operadores;

use App\Models\Operador;
use Livewire\Component;

class OperadorDelete extends Component
{
    public $operadorID,$modalDelete=false;
    public $oName;
    public function ConfirmDelete($id){
        $supplier=Operador::find($id);
        $this->oName=$supplier->name;
        $this->modalDelete=true;
    }
    public function DeleteOperador($id){
        $supplierDel=Operador::find($id);
        $supplierDel->status="Inactivo";
        $supplierDel->delete();
        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        return view('livewire.operadores.operador-delete');
    }
}
