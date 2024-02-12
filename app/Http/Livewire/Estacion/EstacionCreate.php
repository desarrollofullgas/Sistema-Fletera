<?php

namespace App\Http\Livewire\Estacion;

use Livewire\Component;
use App\Models\User;
use App\Models\Zona;
use App\Models\Estacion;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EstacionCreate extends Component
{
    public $newgEstacion;
    public $supervisor, $gerente, $zona, $itsTrue;
    public $name, $zonas, $users, $isSuper, $isGeren,$numero;
    public $razon,$rfc,$siic,$direccion;

    public $currentStep = 1;

    public function resetFilters()
    {
        $this->reset(['name', 'zona', 'supervisor', 'gerente', 'isSuper', 'isGeren','razon','rfc','siic','direccion','numero']);
    }

    public function mount()
    {
        
        $this->resetFilters();

        $this->newgEstacion = false;
    }

    public function showModalFormEstacion()
    {
        $this->resetFilters();

        $this->newgEstacion=true;
    }

    public function nextStep() //funcion siguiente con validacion
    {
        $this->validate( [
            'name' => ['required', 'max:250'],
            'numero' => ['required', 'max:250'],
            'razon' => ['required', 'max:250'],
            'rfc' => ['required', 'max:250'],
            'siic' => ['required', 'max:250'],
            //'zona' => ['required', 'not_in:0']
        ],
        [
            'name.required' => 'El Nombre de la Estación es obligatorio',
            'numero.required' => 'El Número de la Estación es obligatorio',
            'razon.required' => 'La Razón Social de la Estación es obligatorio',
            'rfc.required' => 'El RFC de la Estación es obligatorio',
            'siic.required' => 'El Número SIIC de la Estación es obligatorio',
            'name.max' => 'El Nombre de la Estación no debe ser mayor a 250 caracteres',
            //'zona.required' => 'La Zona es obligatoria'
        ]);

        $this->currentStep++;
    }
    public function nextStep2() //funcion 2 siguiente con validacion
    {
        $this->validate(
            [
                'direccion' => ['required', 'not_in:0'],
                'zona' => ['required', 'not_in:0'],
                //'supervisor' => ['required', 'not_in:0'],
                //'gerente' => ['required', 'not_in:0'],
            ],
            [
                //'supervisor.required' => 'El Supervisor es obligatorio',
                //'gerente.required' => 'El Gerente es obligatorio',
                'direccion.required' => 'La Dirección es obligatoria',
                'zona.required' => 'La Zona es obligatoria'
            ]
        );
        $this->currentStep++;
    }

    public function previousStep() //funcion retroceder 
    {
        $this->currentStep--;
    }

    public function addEstacion()
    {
        $this->validate( [
            'name' => ['required', 'max:250'],
            'numero' => ['required', 'max:250'],
            'razon' => ['required', 'max:250'],
            'rfc' => ['required', 'max:250'],
            'siic' => ['required', 'max:250'],
            'direccion' => ['required', 'not_in:0'],
            'supervisor' => ['required', 'not_in:0'],
            'gerente' => ['required', 'not_in:0'],
            'zona' => ['required', 'not_in:0']
        ],
        [
            'name.required' => 'El Nombre de la Estación es obligatorio',
            'numero.required' => 'El Número de la Estación es obligatorio',
            'name.max' => 'El Nombre de la Estación no debe ser mayor a 250 caracteres',
            'razon.required' => 'La Razón Social de la Estación es obligatorio',
            'rfc.required' => 'El RFC de la Estación es obligatorio',
            'siic.required' => 'El Número SIIC de la Estación es obligatorio',
            'direccion.required' => 'La Dirección es obligatoria',
            'supervisor.required' => 'El Supervisor es obligatorio',
            'gerente.required' => 'El Gerente es obligatorio',
            'zona.required' => 'La Zona es obligatoria'
        ]);

        // if ($this->depaId == '' || $this->depaId == null) {
            DB::transaction(function () {
                return tap(Estacion::create([
                    'name' => $this->name,
                    'num_estacion'=>$this->numero,
                    'zona_id' => $this->zona,
                    'user_id' => $this->gerente,
                    'supervisor_id' => $this->supervisor,
                ]));
            });

        $this->mount();

        // Alert::success('Nueva Estacion', "La Estacion". ' '.$this->name. ' '. "ha sido agregada al sistema");
        session()->flash('flash.banner', 'Nueva Estación, la estación "'.$this->name.'" ha sido agregada al sistema.');
        session()->flash('flash.bannerStyle', 'success');
        
        return redirect(request()->header('Referer'));
    }

    public function updatedZona($id)
    {
        $this->isSuper = User::join('user_zona', 'users.id', 'user_zona.user_id')
        ->where('user_zona.zona_id', $id)->where('permiso_id',2)->select('users.*')->get();

    $this->isGeren = User::join('user_zona', 'users.id', 'user_zona.user_id')
        ->where('user_zona.zona_id', $id)->where('permiso_id',3)->select('users.*')->get();
    }

    public function render()
    {
        $this->zonas = Zona::where('status', 'Activo')->get();
        return view('livewire.estacion.estacion-create');
    }
}
