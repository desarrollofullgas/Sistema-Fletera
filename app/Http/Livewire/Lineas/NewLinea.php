<?php

namespace App\Http\Livewire\Lineas;

use App\Models\Linea;
use Livewire\Component;

class NewLinea extends Component
{
    public $name,$clave,$rfc;

    public function addLinea(){
        $this->validate([
            'name' =>['required'],
            'clave' =>['required'],
            'rfc' =>['required']
        ],[
            'name.required' =>'Ingrese el nombre para la línea de transporte',
            'clave.required' =>'Ingrese la clave del transportista',
            'rfc.required' =>'Igrese el rfc'
        ]);

        $linea=new Linea();
        $linea->name=$this->name;
        $linea->clave=$this->clave;
        $linea->rfc=$this->rfc;
        $linea->save();

        session()->flash('flash.banner', 'Nueva Linea Transportista, la  linea transportista "'.$this->name.'" ha sido agregada al sistema.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(request()->header('Referer'));

    }
    public function render()
    {
        return view('livewire.lineas.new-linea');
    }
}
