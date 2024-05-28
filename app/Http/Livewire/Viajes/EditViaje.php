<?php

namespace App\Http\Livewire\Viajes;

use App\Models\Cataport;
use App\Models\Combustible;
use App\Models\Estacion;
use App\Models\Operador;
use App\Models\Pipa;
use App\Models\Proveedor;
use App\Models\Unidad;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class EditViaje extends Component
{
    public $viajeID;
    public $estaciones,$proveedores=[],$combustibles=[],$operadores,$pipas=[],$unidades;
    //variables para el formulario
    public $estacion,$proveedor,$combustible,$operador,$unidad,$pipa,$contenido,$status;
    public function mount(){
        //datos actuales del registro
        $viaje=Cataport::find($this->viajeID);
        $this->estacion=$viaje->estacion_id;
        $this->proveedor=$viaje->proveedor_id;
        $this->combustible=$viaje->combustible_id;
        $this->operador=$viaje->operador_id;
        $this->unidad=$viaje->unidad_id;
        $this->pipa=$viaje->pipa_id;
        $this->contenido=$viaje->contenido;
        $this->status=$viaje->status;
        //listado de registros
        $this->proveedores=Proveedor::whereHas('zonas',function(Builder $zonas)use($viaje){
            $zonas->where('zona_id',$viaje->estacion->zona_id);
        })->orderBy('name', 'ASC')->get(['id','name']);
        $this->pipas=Pipa::where('unidad_id',$viaje->unidad_id)->get();
        $this->estaciones=Estacion::orderBy('name','ASC')->get(['id','name']);
        $this->operadores=Operador::orderBy('name','ASC')->get(['id','name']);
        $this->unidades=Unidad::where('status','Disponible')->orderBy('tractor','ASC')->get(['id','tractor']);
        $this->combustibles=Combustible::whereHas('info',function(Builder $info)use($viaje){
            $info->where('estacion_id',$viaje->estacion_id);
        })->get();
    }
    //cuando se actualiza el valor de la estación seleccionada se ejecuta la función
    public function updatedEstacion( $val){
        $estacion=Estacion::find($val);
        //buscamos el proveedor según la zona de la estación
        $this->proveedores=Proveedor::whereHas('zonas',function(Builder $zonas)use($estacion){
            $zonas->where('zona_id',$estacion->zona_id);
        })->orderBy('name', 'ASC')->get(['id','name']);
        $this->combustibles=Combustible::where('estacion_id',$estacion->id)->get();
    }
    //ejecutamos la función cuando se actualice la variable $unidad
    public function updatedUnidad($val){
        $unidad=Unidad::find($val);
        $this->pipas=$unidad->toneles;
    }
    public function updateViaje(){
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
        try{
            $viaje=Cataport::find($this->viajeID);
            $viaje->estacion_id=$this->estacion;
            $viaje->combustible_id=$this->combustible;
            $viaje->proveedor_id=$this->proveedor;
            $viaje->unidad_id=$this->unidad;
            $viaje->pipa_id=$this->pipa;
            $viaje->operador_id=$this->operador;
            $viaje->contenido=$this->contenido;
            $viaje->status=$this->status;
            $viaje->save();
            session()->flash('flash.banner', 'Viaje Actualizado');
            session()->flash('flash.bannerStyle', 'success');
            return redirect(request()->header('Referer'));
        }catch(Exception $error){
            session()->flash('flash.banner','Ha ocurrido un error, por favor contacte a un administrador: '.$error->getMessage());
            session()->flash('flash.bannerStyle', 'danger');
            return redirect(request()->header('Referer'));
        }
        
    }
    public function render()
    {
        return view('livewire.viajes.edit-viaje');
    }
}
