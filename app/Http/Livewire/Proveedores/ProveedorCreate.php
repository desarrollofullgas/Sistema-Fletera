<?php

namespace App\Http\Livewire\Proveedores;

use App\Models\Proveedor;
use App\Models\Zona;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProveedorCreate extends Component
{
    public $newgProv;
    public $name, $razon_social, $direccion, $rfc;
    public $zonas, $zonasList;

    //variables para crear usuario que no sea un gerente, supervisor, administrador o compras
    public $selectZonas = false;

    public function resetFilters()
    {
        $this->reset(['name', 'razon_social', 'direccion', 'rfc']);
    }

    public function mount()
    {
        $this->zonas = Zona::where('status', 'Activo')->orderBy('name', 'asc')->get();

        $this->newgProv = false;
    }

    public function showModalFormProv()
    {

        $this->resetFilters();

        $this->newgProv = true;
    }

    public function addProveedor()
    {
        $this->validate(
            [
                'name' => ['required', 'min:3', 'max:500'],
                'razon_social' => ['required', 'min:3', 'max:500'],
                'direccion' => ['required', 'min:3', 'max:500'],
                'rfc' => ['required', 'min:3', 'max:500'],
            ],
            [
                'name.required' => 'El Nombre de el Proveedor es obligatorio',
                'name.max' => 'El Nombre de el Proveedor no debe ser mayor a 500 caracteres',
                'name.min' => 'El Nombre de el Proveedor debe ser mayor a 3 caracteres',
                'razon_social.required' => 'La Razón Social de el Proveedor es obligatorio',
                'razon_social.max' => 'La Razón Social de el Proveedor no debe ser mayor a 500 caracteres',
                'razon_social.min' => 'La Razón Social de el Proveedor debe ser mayor a 3 caracteres',
                'direccion.required' => 'La Dirección de el Proveedor es obligatorio',
                'direccion.max' => 'La Dirección de el Proveedor no debe ser mayor a 500 caracteres',
                'direccion.min' => 'La Dirección de el Proveedor debe ser mayor a 3 caracteres',
                'rfc.required' => 'El RFC de el Proveedor es obligatorio',
                'rfc.max' => 'El RFC de el Proveedor no debe ser mayor a 500 caracteres',
                'rfc.min' => 'El RFC de el Proveedor debe ser mayor a 3 caracteres',
            ]
        );

        $proveedor = Proveedor::create([
            'name' => $this->name,
            'razon_social' => $this->razon_social,
            'direccion' => $this->direccion,
            'rfc' => $this->rfc,
        ]);
        $proveedor->zonas()->sync($this->zonasList);

        session()->flash('flash.banner', 'Nuevo Proveedor "' . $this->name . '" ha sido agregado al sistema.');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        return view('livewire.proveedores.proveedor-create');
    }
}
