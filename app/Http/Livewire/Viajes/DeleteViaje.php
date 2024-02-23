<?php

namespace App\Http\Livewire\Viajes;

use App\Models\Cataport;
use Exception;
use Livewire\Component;

class DeleteViaje extends Component
{
    public $viajeID;
    public function deleteViaje(){
        try{
            $viaje=Cataport::find($this->viajeID);
            $viaje->delete();
            session()->flash('flash.banner', 'Un viaje ha sido eliminado.');
            session()->flash('flash.bannerStyle', 'success');
            //volvemos a la direccion que tiene el navegador
            return redirect(request()->header('Referer'));
        }catch(Exception $error){
            session()->flash('flash.banner','Ha ocurrido un error, por favor contacte a un administrador: '.$error->getMessage());
            session()->flash('flash.bannerStyle', 'danger');
            return redirect(request()->header('Referer'));
        }
    }
    public function render()
    {
        return view('livewire.viajes.delete-viaje');
    }
}
