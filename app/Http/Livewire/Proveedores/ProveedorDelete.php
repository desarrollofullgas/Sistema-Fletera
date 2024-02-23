<?php

namespace App\Http\Livewire\Proveedores;

use App\Models\Proveedor;
use Livewire\Component;

class ProveedorDelete extends Component
{
    public $proveedorID,$modalDelete=false;
    public $pName;
    public function ConfirmDelete($id){
        $supplier=Proveedor::find($id);
        $this->pName=$supplier->name;
        $this->modalDelete=true;
    }
    public function DeleteProveedor($id){
        $supplierDel=Proveedor::find($id);
        $supplierDel->status="Inactivo";
        $supplierDel->delete();
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.proveedores.proveedor-delete');
    }
}
