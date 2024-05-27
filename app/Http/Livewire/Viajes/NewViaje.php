<?php

namespace App\Http\Livewire\Viajes;

use App\Models\Cataport;
use App\Models\Combustible;
use App\Models\Estacion;
use App\Models\Operador;
use App\Models\Proveedor;
use App\Models\ProveedorZona;
use App\Models\Unidad;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewViaje extends Component
{
    public $estaciones,$proveedores=[],$combustibles=[],$operadores,$pipas=[],$unidades;
    //variables para el formulario
    public $estacion,$proveedor,$combustible,$operador,$unidad,$pipa,$contenido;
    public function mount(){
        $user=Auth::user();
        //estaciones de acuerdo al permiso del usuario
        //administrador
        if(in_array($user->permiso_id,[1,4])){
            $this->estaciones=Estacion::orderBy('name','ASC')->get(['id','name']);
        //supervisor
        }elseif($user->permiso_id==2){
            $this->estaciones=Estacion::where('supervisor_id',$user->id)->orderBy('name','ASC')->get(['id','name']);
        //gerente
        }elseif($user->permiso_id==3){
            $this->estaciones=Estacion::where('user_id',$user->id)->orderBy('name','ASC')->get(['id','name']);
        }
        $this->operadores=Operador::orderBy('name','ASC')->get(['id','name']);
        $this->unidades=Unidad::where('status','Disponible')->orderBy('tractor','ASC')->get(['id','tractor']);
    }
    //cuando se actualiza el valor de la estación seleccionada se ejecuta la función
    public function updatedEstacion( $val){
        $estacion=Estacion::find($val);
        //buscamos el proveedor según la zona de la estación
        $this->proveedores=Proveedor::whereHas('zonas',function(Builder $zonas)use($estacion){
            $zonas->where('zona_id',$estacion->zona_id);
        })->orderBy('name', 'ASC')->get(['id','name']);
        $this->combustibles=Combustible::whereHas('info',function(Builder $info)use($estacion){
            $info->where('estacion_id',$estacion->id);
        })->get();
    }
    //ejecutamos la función cuando se actualice la variable $unidad
    public function updatedUnidad($val){
        $unidad=Unidad::find($val);
        $this->pipas=$unidad->toneles;
    }
    public function addViaje(){
        $this->validate([
            'estacion' => ['required'],
            'combustible' => ['required'],
            'proveedor' => ['required'],
            'unidad' => ['required'],
            'operador' => ['required'],
            'pipa' => ['required'],
            'contenido' => ['required','gt:0'],
        ],[
            'estacion.required' => 'Seleccione la estación destino',
            'combustible.required' => 'Seleccione el tipo de combustible',
            'proveedor.required' => 'Seleccione el proveedor',
            'unidades.required' => 'Seleccione una unidad de transporte',
            'operador.required' => 'Seleccione un operador',
            'pipa.required' => 'Seleccione el tonel de la unidad de transporte',
            'contenido.required' => 'Ingrese la cantidad de combustible',
            'contenido.gt' => 'La cantidad debe ser mayor a cero'
        ]);
        $viaje=new Cataport();
        $viaje->estacion_id=$this->estacion;
        $viaje->combustible_id=$this->combustible;
        $viaje->proveedor_id=$this->proveedor;
        $viaje->unidad_id=$this->unidad;
        $viaje->pipa_id=$this->pipa;
        $viaje->operador_id=$this->operador;
        $viaje->contenido=$this->contenido;
        $viaje->status="En tránsito";

        $vehiculo= Unidad::find($this->unidad);
        $vehiculo->status="En tránsito";

        $vehiculo->save();
        $viaje->save();
        session()->flash('flash.banner', 'Viaje registrado');
        session()->flash('flash.bannerStyle', 'success');
        return to_route('viajes');
    }
    public function render()
    {
        return view('livewire.viajes.new-viaje');
    }
}
