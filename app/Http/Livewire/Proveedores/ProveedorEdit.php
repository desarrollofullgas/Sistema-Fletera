<?php

namespace App\Http\Livewire\Proveedores;

use App\Models\Proveedor;
use Livewire\Component;

class ProveedorEdit extends Component
{
    public $EditProv;
    public $prov_id, $name, $status,$razon_social,$rfc,$direccion,$origen,$busqueda;

    public function resetFilters()
    {
        $this->reset(['name','razon_social','direccion','rfc','origen','busqueda','status']);
    }

    public function mount()
    {
        $this->resetFilters();

        $this->EditProv = false;
    }

    public function confirmProvEdit(int $id)
    {
        $proveedor = Proveedor::where('id', $id)->first();

        $this->prov_id = $id;
        $this->name = $proveedor->name;
        $this->razon_social = $proveedor->razon_social;
        $this->direccion = $proveedor->direccion;
        $this->rfc = $proveedor->rfc;
        $this->origen = $proveedor->origen;
        $this->busqueda = $proveedor->busqueda;
        $this->status = $proveedor->status;

        $this->EditProv = true;
    }

    public function EditarProveedor($id)
    {
        $proveedor = Proveedor::where('id', $id)->first();

        $this->validate([
            'name' => ['required', 'max:500'],
            'status' => ['required', 'not_in:0'],
        ],
        [
            'name.required' => 'El Nombre del Proveedor es obligatorio',
            'name.max' => 'El Nombre del Proveedor no debe ser mayor a 500 caracteres',

            'status.required' => 'El Status es obligatorio'
        ]);

        $proveedor->forceFill([
            'name' => $this->name,
            'razon_social' => $this->razon_social,
            'direccion' => $this->direccion,
            'rfc' => $this->rfc,
            'origen' => $this->origen,
            'busqueda' => $this->busqueda,
            'status' => $this->status,
        ])->save();

        $this->mount();
    
        session()->flash('flash.banner', 'Proveedor Actualizado, " ' . $proveedor->name . ' " ha sido actualizado en el sistema.');
        session()->flash('flash.bannerStyle', 'success');
        
        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        return view('livewire.proveedores.proveedor-edit');
    }
}
