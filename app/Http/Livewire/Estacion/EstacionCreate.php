<?php

namespace App\Http\Livewire\Estacion;

use App\Models\Combustible;
use App\Models\Dispensario;
use Livewire\Component;
use App\Models\User;
use App\Models\Zona;
use App\Models\Estacion;
use Exception;

class EstacionCreate extends Component
{
    public $zonas;
    public $name, $numero, $razon, $rfc, $siic, $iva, $direccion, $zona, $supervisor, $gerente, $combustibles = [];
    public $isSuper, $isGeren;
    public $optionSelected; // Nueva propiedad para almacenar la opción seleccionada (ej.  dispensarios)
    public $dispensarios = [];

    public function resetFilters()
    {
        $this->reset(['name', 'zona', 'supervisor', 'gerente', 'isSuper', 'isGeren', 'razon', 'rfc', 'siic', 'direccion', 'numero', 'iva']);
    }

    public function mount()
    {
        $this->zonas = Zona::where('status', 'Activo')->get();
    }

    public function addEstacion()
    {
        $this->validate(
            [
                'name' => ['required', 'max:250'],
                'numero' => ['required', 'max:250'],
                'razon' => ['required', 'max:250'],
                'rfc' => ['required', 'max:250'],
                'siic' => ['required', 'max:250'],
                'iva' => ['required'],
                'direccion' => ['required', 'not_in:0'],
                'supervisor' => ['required', 'not_in:0'],
                'gerente' => ['required', 'not_in:0'],
                'zona' => ['required', 'not_in:0'],
                'combustibles' => ['required'],
                'combustibles.*.tipo' => ['required'],
                'combustibles.*.capacidad' => ['required'],
            ],
            [
                'name.required' => 'El Nombre de la Estación es obligatorio',
                'numero.required' => 'El Número de la Estación es obligatorio',
                'name.max' => 'El Nombre de la Estación no debe ser mayor a 250 caracteres',
                'razon.required' => 'La Razón Social de la Estación es obligatorio',
                'rfc.required' => 'El RFC de la Estación es obligatorio',
                'siic.required' => 'El Número SIIC de la Estación es obligatorio',
                'iva.required' => 'El IVA de la Estación es obligatorio',
                'direccion.required' => 'La Dirección es obligatoria',
                'supervisor.required' => 'El Supervisor es obligatorio',
                'gerente.required' => 'El Gerente es obligatorio',
                'zona.required' => 'La Zona es obligatoria',
            ]
        );

        try {
            $estacion = new Estacion();
            $estacion->name = $this->name;
            $estacion->num_estacion = $this->numero;
            $estacion->razon_social = $this->razon;
            $estacion->rfc = $this->rfc;
            $estacion->siic = $this->siic;
            $estacion->iva = $this->iva;
            $estacion->direccion = $this->direccion;
            $estacion->zona_id = $this->zona;
            $estacion->user_id = $this->gerente;
            $estacion->supervisor_id = $this->supervisor;
            $estacion->save();
            //guardamos los combustibles de la estacion 
            foreach ($this->combustibles as $combustible) {
                $reg = new Combustible();
                $reg->estacion_id = $estacion->id;
                $reg->tipo = $combustible['tipo'];
                $reg->capacidad = $combustible['capacidad'];
                $reg->prom_venta = $combustible['prom_venta'];
                $reg->dif_vr_fisico = $combustible['dif_vr_fisico'];
                $reg->minimo = $combustible['minimo'];
                $reg->alerta = $combustible['alerta'];
                // Asignar la clave de acuerdo al tipo de combustible
                switch ($combustible['tipo']) {
                    case 'MAGNA':
                        $reg->clave = '32025 Gasolina con contenido minimo 87 octanos';
                        break;
                    case 'PREMIUM':
                        $reg->clave = '32026 Gasolina con contenido minimo 91 octanos';
                        break;
                    case 'DIESEL':
                        $reg->clave = '34015 Diesel Automotriz';
                        break;
                    default:
                        // Manejar caso por defecto o lanzar una excepción si es necesario
                        break;
                }
                $reg->save();
            }
            // Guardar detalles del dispensario
            foreach ($this->dispensarios as $dispensario) {
                $reg = new Dispensario();
                $reg->estacion_id = $estacion->id;
                $reg->marca = $dispensario['marca'];
                $reg->modelo = $dispensario['modelo'];
                $reg->mangueras = $dispensario['mangueras'];
                $reg->flujo = $dispensario['flujo'];
                $reg->serie = $dispensario['serie'];
                $reg->version_cpu = $dispensario['version_cpu'];
                $reg->save();
            }

            session()->flash('flash.banner', 'Nueva Estación, la estación "' . $this->name . '" ha sido agregada al sistema.');
            session()->flash('flash.bannerStyle', 'success');
            return redirect(request()->header('Referer'));
        } catch (Exception $error) {
            session()->flash('flash.banner', 'Ha ocurrido un error al ingresar la estación. Pongase en contacto con un administrador y proporcione el siguiente código:' . $error->getMessage());
            session()->flash('flash.bannerStyle', 'danger');
            return redirect(request()->header('Referer'));
        }
        $this->mount();
    }

    public function updatedZona($id)
    {
        $this->isSuper = User::join('user_zona', 'users.id', 'user_zona.user_id')
            ->where('user_zona.zona_id', $id)->where('permiso_id', 2)->select('users.*')->get();

        $this->isGeren = User::join('user_zona', 'users.id', 'user_zona.user_id')
            ->where('user_zona.zona_id', $id)->where('permiso_id', 3)->select('users.*')->get();
    }

    public function render()
    {
        return view('livewire.estacion.estacion-create');
    }
}
