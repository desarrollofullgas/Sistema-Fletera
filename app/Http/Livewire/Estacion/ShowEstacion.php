<?php

namespace App\Http\Livewire\Estacion;

use Livewire\Component;
use App\Models\Zona;
use App\Models\User;
use App\Models\Estacion;
use Carbon\Carbon;

class ShowEstacion extends Component
{
    public $ShowgEstacion;
    public $estacion_show_id, $producto, $zonastat, $gerentestat, $supervisorstat,$estacion,$estacionID;
    public $titulo_estacion, $zonas, $ubicacion, $created_at, $gerente, $supervisor, $status, $numero;
    public $estaciones, $user_gerentes,$user_supervisores,$razon,$rfc,$siic,$iva,$num_cre,$direccion,$propietario;

    public function mount()
    {
        $this->estacion = Estacion::find($this->estacionID);
        $this->ShowgEstacion = false;
    }

    public function confirmShowEstacion(int $id){
        $estacion = Estacion::where('id', $id)->first();

        $this->estacion_show_id = $id;
        $this->titulo_estacion = $estacion->name;
        $this->numero = $estacion->num_estacion;
        $this->razon = $estacion->razon_social;
        $this->rfc = $estacion->rfc;
        $this->siic = $estacion->siic;
        $this->iva = $estacion->iva;
        $this->num_cre = $estacion->num_cre;
        $this->direccion = $estacion->direccion;
        $this->propietario = $estacion->propietario;
        $this->zonas = $estacion->zona->name;
        $this->created_at = Carbon::parse($estacion['created_at'])->isoFormat('D MMMM Y  h:mm:ss ');

        $this->user_gerentes = $estacion->user;

        if ($this->user_gerentes != null) {
            $this->gerente = $estacion->user->name;

            $this->gerentestat = $estacion->user->flag_trash;
        } else {
            $this->gerente = "Sin Gerente en esta Estación";
        }

        $this->user_supervisores = $estacion->supervisor;

        if ($this->user_supervisores != null) {
            $this->supervisor = $estacion->supervisor->name;

            $this->supervisorstat = $estacion->supervisor->flag_trash;
        } else {
            $this->supervisor = "Sin Supervisor en esta Estación";
        }

        $this->status = $estacion->status;

        $this->ShowgEstacion=true;
    }

    public function render()
    {
        $this->estaciones = Estacion::where('id', $this->estacion_show_id)->first();

        return view('livewire.estacion.show-estacion');
    }
}
