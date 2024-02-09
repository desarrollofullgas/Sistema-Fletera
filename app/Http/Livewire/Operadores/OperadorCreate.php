<?php

namespace App\Http\Livewire\Operadores;

use App\Models\Operador;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class OperadorCreate extends Component
{
    public $newgOp;
    public $name,$licencia,$rfc;

    public function resetFilters()
    {
        $this->reset(['name','licencia','rfc']);
    }

    public function mount()
    {
        $this->resetFilters();

        $this->newgOp = false;
    }

    public function showModalFormOp()
    {

        $this->resetFilters();

        $this->newgOp = true;
    }

    public function addOperador()
    {
        $this->validate(
            [
                'name' => ['required', 'min:3', 'max:250'],
                'licencia' => ['required', 'min:3', 'max:250'],
                'rfc' => ['required', 'min:3', 'max:250'],
            ],
            [
                'name.required' => 'El Nombre de el Operador es obligatorio',
                'name.max' => 'El Nombre de el Operador no debe ser mayor a 250 caracteres',
                'name.min' => 'El Nombre de el Operador debe ser mayor a 3 caracteres',
                'licencia.required' => 'La Licencia de el Operador es obligatorio',
                'licencia.max' => 'La Licencia de el Operador no debe ser mayor a 250 caracteres',
                'licencia.min' => 'La Licencia de el Operador debe ser mayor a 3 caracteres',
                'rfc.required' => 'El RFC de el Operador es obligatorio',
                'rfc.max' => 'El RFC de el Operador no debe ser mayor a 250 caracteres',
                'rfc.min' => 'El RFC de el Operador debe ser mayor a 3 caracteres',
            ]
        );

        try {
            $operador = Operador::create([
                'name' => $this->name,
                'licencia' => $this->licencia,
                'rfc' => $this->rfc,
            ]);
        } catch (\Exception $e) {
            // Manejar la excepción
            Log::error('Error al crear un operador: ' . $e->getMessage());
            // También podrías devolver un mensaje de error al usuario
        }

        $this->mount();


        session()->flash('flash.banner', 'Nuevo Operador "' . $this->name . '" ha sido agregado al sistema.');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('operadores');
    }
    public function render()
    {
        return view('livewire.operadores.operador-create');
    }
}
