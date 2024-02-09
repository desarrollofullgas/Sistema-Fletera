<?php

namespace App\Http\Livewire\Operadores;

use App\Models\Operador;
use Livewire\Component;

class OperadorEdit extends Component
{
    public $EditOp;
    public $ope_id, $name, $status,$licencia,$rfc;

    public function resetFilters()
    {
        $this->reset(['name','status','licencia','rfc']);
    }

    public function mount()
    {
        $this->resetFilters();

        $this->EditOp = false;
    }

    public function confirmOpEdit(int $id)
    {
        $operador = Operador::where('id', $id)->first();

        $this->ope_id = $id;
        $this->name = $operador->name;
        $this->licencia = $operador->licencia;
        $this->rfc = $operador->rfc;
        $this->status = $operador->status;

        $this->EditOp = true;
    }

    public function EditarOperador($id)
    {
        $operador = Operador::where('id', $id)->first();

        $this->validate([
            'name' => ['required', 'string', 'max:250'],
            'status' => ['required', 'not_in:0'],
        ],
        [
            'name.required' => 'El Nombre de la Zona es obligatorio',
            'name.string' => 'El Nombre de la Zona debe ser solo Texto',
            'name.max' => 'El Nombre de la Zona no debe ser mayor a 250 caracteres',
            'status.required' => 'El Status es obligatorio'
        ]);

        $operador->forceFill([
            'name' => $this->name,
            'licencia' => $this->licencia,
            'rfc' => $this->rfc,
            'status' => $this->status,
        ])->save();

        $this->mount();
    
        session()->flash('flash.banner', 'Operador Actualizado, " ' . $operador->name . ' " ha sido actualizado en el sistema.');
        session()->flash('flash.bannerStyle', 'success');
        
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.operadores.operador-edit');
    }
}
