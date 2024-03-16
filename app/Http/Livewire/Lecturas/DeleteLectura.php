<?php

namespace App\Http\Livewire\Lecturas;

use App\Models\Lectura;
use App\Models\LecturaDetalle;
use Exception;
use Livewire\Component;

class DeleteLectura extends Component
{
    public $lecturaID;

    public function deleteLectura(){
        try{
            $lectura=LecturaDetalle::find($this->lecturaID);
            $lectura->delete();
            session()->flash('flash.banner', 'El rgistro ha sido eliminado');
            session()->flash('flash.bannerStyle', 'success');
            return redirect(request()->header('Referer'));
        }catch(Exception $error){
            session()->flash('flash.banner', 'Ha ocurrido un error . Pongase en contacto con un administrador y proporcione el siguiente código:' . $error->getMessage());
            session()->flash('flash.bannerStyle', 'danger');
            return redirect(request()->header('Referer'));
        }
    }
    public function render()
    {
        return view('livewire.lecturas.delete-lectura');
    }
}
