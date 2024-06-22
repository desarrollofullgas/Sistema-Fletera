<?php

namespace App\Http\Livewire\Lecturas;

use App\Models\Lectura;
use App\Models\LecturaDetalle;
use Exception;
use Livewire\Component;

class EditLectura extends Component
{
    public $lecturaID,$lts,$total,$data=[];
    public function mount(){
        $lectura=Lectura::find($this->lecturaID);
        $this->lts=$lectura->total_litros;
        $this->total=$lectura->total_pesos;
        $lectura->detalles->map(function($lectura){
            array_push($this->data,[
                'id'=>$lectura->id,
                'combustible'=>$lectura->combustible->combustible->tipo,
                'capacity'=>$lectura->combustible->capacidad,
                'v'=>$lectura->veeder,
                'f'=>$lectura->fisico,
                'vp'=>$lectura->venta_periferico,
                've'=>$lectura->venta_electronica,
                'vo'=>$lectura->venta_odometro
            ]);
        });
    }
    public function updateLectura(){
        //validaciones de los campos del formulario
        $this->validate([
            'lts'=>['required','gt:0'],
            'total'=>['required','gt:0'],
            'data.*.*'=>['required'],
            'data.*.v'=>['gt:0'],
            'data.*.f'=>['gt:0'],
            'data.*.vp'=>['gt:0'],
            'data.*.ve'=>['gt:0'],
            'data.*.vo'=>['gt:0']
        ],[
            'total.required'=>'Este campo es requerido',
            'total.gt'=>'El valor debe ser mayor a cero',
            'lts.required'=>'Este campo es requerido',
            'lts.gt'=>'El valor debe ser mayor a cero',
            'data.*.*.required'=>'Este campo es requerido',
            'data.*.v.gt'=>'El valor debe ser mayor a cero',
            'data.*.f.gt'=>'El valor debe ser mayor a cero',
            'data.*.vp.gt'=>'El valor debe ser mayor a cero',
            'data.*.ve.gt'=>'El valor debe ser mayor a cero',
            'data.*.vo.gt'=>'El valor debe ser mayor a cero',
        ]);
        //Al pasar las validaciones ejecutamos el código dentro de un try catch para evitar algún error
        try{
            $lectura=Lectura::find($this->lecturaID);
            $lectura->total_litros=$this->lts;
            $lectura->total_pesos=$this->total;
            $lectura->save();

            foreach($this->data as $data){
                $lecDetail=LecturaDetalle::find($data['id']);
                $lecDetail->veeder=$data['v'];
                $lecDetail->fisico=$data['f'];
                $lecDetail->venta_periferico=$data['vp'];
                $lecDetail->venta_electronica=$data['ve'];
                $lecDetail->venta_odometro=$data['vo'];
                $lecDetail->save();
            }
            session()->flash('flash.banner', 'Información actualizada');
            session()->flash('flash.bannerStyle', 'success');
            return redirect(request()->header('referer'));
        }catch(Exception $e){
            session()->flash('flash.banner', 'Ha ocurrido un error al guardar los cambios');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect(request()->header('referer'));
        }
    }
    public function render()
    {
        return view('livewire.lecturas.edit-lectura');
    }
}
