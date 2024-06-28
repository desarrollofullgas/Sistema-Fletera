<?php

namespace App\Http\Livewire\Recepcion;

use App\Models\RecepcionPipa;
use App\Models\Unidad;
use Exception;
use Livewire\Component;

class DeleteRecepcion extends Component
{
    public $recepcionID,$recepcion;
    public function mount(){
        $this->recepcion=RecepcionPipa::find($this->recepcionID);
    }
    public function deleteRecepcion(){
        try{
            $recepcion=RecepcionPipa::find($this->recepcionID);
            $unidad=Unidad::find($recepcion->cataporte->unidad_id);
            $unidad->status="Disponible";
            $unidad->save();
            $recepcion->delete();
            session()->flash('La recepcion del carta porte #'.$this->recepcion->cataporte->id.' ha sido eliminada');
            session()->flash('flash.bannerStyle','success');
            return redirect(request()->header('Referer'));

        }catch(Exception $error){
            session()->flash('flash.banner', 'Ha ocurrido un error al realizar la acción. Pongase en contacto con un administrador y proporcione el siguiente código:'.$error->getMessage());
            session()->flash('flash.bannerStyle', 'danger');
            return  redirect(request()->header('Referer'));
        }
    }
    public function render()
    {
        return view('livewire.recepcion.delete-recepcion');
    }
}
