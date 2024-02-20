<?php

namespace App\Http\Livewire\Viajes;

use App\Models\Combustible;
use App\Models\Estacion;
use App\Models\Operador;
use App\Models\Proveedor;
use Livewire\Component;

class NewViaje extends Component
{
    public $estaciones,$proveedores=[],$combustibles=[],$operadores,$pipas=[],$unidades;
    public function mount(){
        $this->estaciones=Estacion::orderBy('name','ASC')->get('id','name');
        $this->proveedores=Proveedor::orderBy('name','ASC')->get('id','name');
        //de prueba en lo que se acaban sus respectivos módulos
        $this->combustibles=Combustible::orderBy('name','ASC')->get('id','name');
        $this->operadores=Operador::orderBy('name','ASC')->get('id','name');
    }
    public function addViaje(){
        dd('holi');
    }
    public function render()
    {
        return view('livewire.viajes.new-viaje');
    }
}
