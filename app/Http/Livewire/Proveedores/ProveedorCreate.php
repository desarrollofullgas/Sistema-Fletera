<?php

namespace App\Http\Livewire\Proveedores;

use App\Models\Proveedor;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProveedorCreate extends Component
{
    public $newgProv;
    public $name,$razon_social,$direccion,$rfc,$origen;

    public function resetFilters()
    {
        $this->reset(['name','razon_social','direccion','rfc','origen']);
    }

    public function mount()
    {
        $this->resetFilters();

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
                'name' => ['required'],
                'razon_social' => ['required'],
                'rfc' => ['required'],
                'origen' => ['required'],
            ],
            [
                'name.required' => 'El Nombre de el Proveedor es obligatorio',
                'razon_social.required' => 'La Razón Social del Proveedor es obligatorio',
                'rfc.required' => 'El RFC de el Proveedor es obligatorio',
            ]
        );

        try {
            $proveedor = Proveedor::create([
                'name' => $this->name,
                'razon_social' => $this->licencia,
                'direccion' => $this->licencia,
                'rfc' => $this->licencia,
                'origen' => $this->rfc,
            ]);
        } catch (\Exception $e) {
            // Manejar la excepción
            Log::error('Error al crear un proveedor: ' . $e->getMessage());
            // También podrías devolver un mensaje de error al usuario
        }

        $this->mount();


        session()->flash('flash.banner', 'Nuevo Proveedor "' . $this->name . '" ha sido agregado al sistema.');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('operadores');
    }
    
    public function render()
    {
        return view('livewire.proveedores.proveedor-create');
    }
}
