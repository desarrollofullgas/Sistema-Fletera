<?php

namespace App\Http\Livewire\Lineas;

use App\Models\Linea;
use Livewire\Component;

class EditLinea extends Component
{
    public $lineaID,$name,$clave,$rfc;
    public function mount(){
        $linea=Linea::find($this->lineaID);
        $this->name=$linea->name;
        $this->clave=$linea->clave;
        $this->rfc=$linea->rfc;
    }
    public function updateLinea(){
        $this->validate([
            'name' =>['required'],
            'clave' =>['required'],
            'rfc' =>['required']
        ],[
            'name.required' =>'Ingrese el nombre para la línea de transporte',
            'clave.required' =>'Ingrese la clave del transportista',
            'rfc.required' =>'Igrese el rfc'
        ]);
        $linea=Linea::find($this->lineaID);
        $linea->name=$this->name;
        $linea->clave=$this->clave;
        $linea->rfc=$this->rfc;
        $linea->save();
        session()->flash('flash.banner', 'Se ha actualizado una línea de transporte');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        return view('livewire.lineas.edit-linea');
    }
}
