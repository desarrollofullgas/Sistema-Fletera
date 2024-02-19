<?php

namespace App\Http\Livewire\Unidades;

use App\Models\Linea;
use App\Models\Pipa;
use App\Models\Unidad;
use Exception;
use Livewire\Component;

class EditUnidad extends Component
{
    public $unidadID,$lineas;
    public $tractor,$linea,$placa,$marca,$modelo,$serie,$capacidad,$toneles=[],$pipas=[];
    public function mount(){
        $unidad=Unidad::find($this->unidadID);
        $this->lineas=Linea::all(['id','name']);
        $this->tractor=$unidad->tractor;
        $this->linea=$unidad->linea_id;
        $this->placa=$unidad->placa;
        $this->marca=$unidad->marca;
        $this->serie=$unidad->serie;
        $this->capacidad=$unidad->capacidad;
        $this->toneles();
    }
    public function toneles(){
        $this->toneles=[];
        $tonels=Pipa::where('unidad_id',$this->unidadID)->orderBy('id','DESC')->get();
        foreach($tonels as $tonel){
            array_push($this->toneles,[
                'id' => $tonel->id,
                'tipo' =>$tonel->toneles,
                'placa' => $tonel->placa,
                'marca' => $tonel->marca,
                'modelo' => $tonel->modelo,
                'serie' => $tonel->serie
            ]);
        }
    }
    public function tonelDelete($id){
        $tonel=Pipa::find($id);
        $tonel->delete();
        $this->toneles();
    }
    public function unidadUpdate(){
        $this->validate([
            'tractor'=>['required'],
            'capacidad'=>['required'],
            'linea'=>['required']
        ],[
            'tractor.required'=>'El número de unidad es requerido',
            'capacidad.required'=>'Ingrese la capacidad total de la unidad',
            'linea.required'=>'Seleccione el trasportista al que pertenece la unidad',
        ]);
        try{
            $unidad=Unidad::find($this->unidadID);
            $unidad->linea_id=$this->linea;
            $unidad->tractor=$this->tractor;
            $unidad->placa=$this->placa;
            $unidad->marca=$this->marca;
            $unidad->modelo=$this->modelo;
            $unidad->serie=$this->serie;
            $unidad->capacidad=$this->capacidad;
            //actualizamos los datos de las pipas actuales
            foreach($this->toneles as $tonel){
                $reg=Pipa::find($tonel['id']);
                $reg->unidad_id=$unidad->id;
                $reg->toneles=$tonel['tipo'];
                $reg->placa=$tonel['placa'];
                $reg->marca=$tonel['marca'];
                $reg->modelo=$tonel['modelo'];
                $reg->serie=$tonel['serie'];
                $reg->save();
            }
            //guardamos las nuevas pipas de la unidad
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
            session()->flash('flash.banner','La información de la unidad ha sido modificada');
            session()->flash('flash.bannerStyle', 'success');
            //volvemos a la direccion que tiene el navegador
            return redirect(request()->header('Referer'));
        }catch(Exception $error){
            session()->flash('flash.banner','Ha ocurrido un error, por favor contacte a un administrador: '.$error->getMessage());
            session()->flash('flash.bannerStyle', 'danger');
            //volvemos a la direccion que tiene el navegador
            return redirect(request()->header('Referer'));
        }
        
    }
    public function render()
    {
        return view('livewire.unidades.edit-unidad');
    }
}
