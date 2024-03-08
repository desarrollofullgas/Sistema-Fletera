<?php

namespace App\Http\Livewire\Lecturas;

use App\Models\Combustible;
use App\Models\Estacion;
use App\Models\Lectura;
use App\Models\LecturaDetalle;
use App\Models\User;
use Livewire\Component;
use Exception;
use Illuminate\Support\Facades\Auth;

class NewLectura extends Component
{
    public $tipo, $combustible, $veeder, $fisico, $vperiferico, $velectronica, $vodometro, $tlitros, $tpesos;

    public $tiposCombustible = [], $estaciones;
    public $estacionId;
    public $detalles = [];

    
public function mount()
{
    if (Auth::user()->permiso_id == 1) {
        $this->estaciones = Estacion::where('status', 'Activo')->orderBy('name', 'asc')->get();
         // Obtener los tipos de combustible asociados a cada estación del usuario autenticado
         $this->tiposCombustible=Combustible::all();
    } else {
        $this->estaciones = Estacion::where('status', 'Activo')->where('user_id', Auth::user()->id)->get();
        // Verificar si hay estaciones asignadas al usuario no administrador
        if ($this->estaciones->isNotEmpty()) {
            // Establecer la estación del usuario autenticado como la primera estación encontrada
            $this->estacionId = $this->estaciones->first()->id;
            // Inicializar el array de tipos de combustible
            $this->tiposCombustible = [];

            // Obtener los tipos de combustible asociados a cada estación del usuario autenticado
            foreach ($this->estaciones as $estacion) {
                $combustibles = Combustible::where('estacion_id', $estacion->id)->get();
                // Almacenar los tipos de combustible asociados a la estación actual
                $this->tiposCombustible[$estacion->id] = $combustibles;
            }
        }
    }
}

    public function updatedEstacionId($value)
    {
        $this->tiposCombustible = Combustible::where('estacion_id', $value)->get();
    }

    public function addLectura()
    {
        $this->validate([
            'tlitros' => ['required'],
            'tpesos' => ['required'],
            'detalles.*.tipo' => ['required'],
            'detalles.*.veeder' => ['required'],
            'detalles.*.fisico' => ['required'],
            'detalles.*.vperiferico' => ['required'],
            'detalles.*.velectronica' => ['required'],
            'detalles.*.vodometro' => ['required'],
        ], [
            'tlitros.required' => 'El Campo es obligatorio',
            'tpesos.required' => 'El Campo es obligatorio',
            'detalles.*.tipo.required' => 'El Tipo de Combustible es Obligatorio',
            'detalles.*.veeder.required' => 'El Valor del  VEEDER es Obligatorio',
            'detalles.*.fisico.required' => 'El Valor Fisico es Obligatorio',
            'detalles.*.vperiferico.required' => 'El Campo es obligatorio es Obligatorio',
            'detalles.*.velectronica.required' => 'El Campo es obligatorio es Obligatorio',
            'detalles.*.vodometro.required' => 'El Campo es obligatorio es Obligatorio',
        ]);

        try {
            $lectura = new Lectura();
            $lectura->total_litros = $this->tlitros;
            $lectura->total_pesos = $this->tpesos;
            //dd($lectura);
            $lectura->save();
            //guardamos los detalles de la lectura
            foreach ($this->detalles as $detalle) {
                $reg = new LecturaDetalle();
                $reg->lectura_id = $lectura->id;
                $reg->combustible_id = $detalle['tipo'];
                $reg->veeder = $detalle['veeder'];
                $reg->fisico = $detalle['fisico'];
                $reg->venta_periferico = $detalle['vperiferico'];
                $reg->venta_electronica = $detalle['velectronica'];
                $reg->venta_odometro = $detalle['vodometro'];
                $reg->save();
            }
            //dd($this->detalles);

            session()->flash('flash.banner', 'Se ha añadido correctamente la Lectura.');
            session()->flash('flash.bannerStyle', 'success');
            return redirect(request()->header('Referer'));
        } catch (Exception $error) {
            session()->flash('flash.banner', 'Ha ocurrido un error . Pongase en contacto con un administrador y proporcione el siguiente código:' . $error->getMessage());
            session()->flash('flash.bannerStyle', 'danger');
            return redirect(request()->header('Referer'));
        }
    }
    public function render()
    {
        return view('livewire.lecturas.new-lectura');
    }
}
