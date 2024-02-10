<?php

namespace App\Http\Livewire\Unidades;

use App\Models\Linea;
use App\Models\Pipa;
use App\Models\Unidad;
use Exception;
use Livewire\Component;

class NewUnidad extends Component
{
    public $lineas;
    public $linea,$tractor,$placa,$marca,$modelo,$serie,$capacidad,$pipas=[];
    public function mount(){
        $this->lineas=Linea::all(['id','name']);
    }
    public function addUnidad(){
        $this->validate([
            'tractor'=>['required'],
            'capacidad'=>['required'],
            'linea'=>['required'],
            'pipas'=>['required'],
            'pipas.*.tonel'=>['required'],
        ],[
            'tractor.required'=>'El número de unidad es requerido',
            'capacidad.required'=>'Ingrese la capacidad total de la unidad',
            'linea.required'=>'Seleccione el trasportista al que pertenece la unidad',
            'pipas.required'=>'Ingrese toda la información requerida',
            'pipas.*.tonel.required'=>'Seleccione el tipo de tonel'
        ]);
        //manejamos el try catch para que la app no se detenga en caso de error
        try{
            $unidad=new Unidad();
            $unidad->tractor=$this->tractor;
            $unidad->linea_id=$this->linea;
            $unidad->capacidad=$this->capacidad;
            $unidad->placa=$this->placa;
            $unidad->marca=$this->marca;
            $unidad->modelo=$this->modelo;
            $unidad->serie=$this->serie;
            $unidad->save();
            //guardamos las pipas de la unidad 
            foreach($this->pipas as $pipa){
                $reg=new Pipa();
                $reg->unidad_id=$unidad->id;
                $reg->toneles=$pipa['tonel'];
                $reg->placa=$pipa['placa'];
                $reg->marca=$pipa['marca'];
                $reg->modelo=$pipa['modelo'];
                $reg->serie=$pipa['serie'];
                $reg->save();
            }
            session()->flash('flash.banner', 'Nueva unidad de transporte añadida.');
            session()->flash('flash.bannerStyle', 'success');
            return to_route('unidades');
        }catch(Exception $error){
            session()->flash('flash.banner', 'Ha ocurrido un error al ingresar la unidad. Pongase en contacto con un administrador y proporcione el siguiente código:'.$error->getMessage());
            session()->flash('flash.bannerStyle', 'success');
            return  to_route('unidades');
        }
    }
    public function render()
    {
        return view('livewire.unidades.new-unidad');
    }
}
