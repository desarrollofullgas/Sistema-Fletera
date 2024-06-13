<?php

namespace App\Http\Livewire\Estacion;

use App\Models\Combustible;
use App\Models\Dispensario;
use App\Models\Estacion;
use App\Models\EstacionCombustible;
use App\Models\User;
use App\Models\Zona;
use Exception;
use Livewire\Component;

class EstacionEdit extends Component
{
    public $estacionID, $zonas;
    public $name, $numero, $razon, $propietario, $rfc, $siic, $iva, $num_cre, $cre, $direccion, $zona, $supervisor, $gerente, $status, $isSuper, $isGeren, $productos, $combustibles = [], $newCombustibles = [], $dispensarios = [], $newDispensarios = [];

    public function mount()
    { //cargamos y mostramos los datos de la estacion
        $estacion = Estacion::find($this->estacionID);
        $this->productos = Combustible::all(['id', 'tipo']);
        $this->zonas = Zona::where('status', 'Activo')->get();
        $this->name = $estacion->name;
        $this->numero = $estacion->num_estacion;
        $this->razon = $estacion->razon_social;
        $this->rfc = $estacion->rfc;
        $this->siic = $estacion->siic;
        $this->iva = $estacion->iva;
        $this->cre = $estacion->num_cre;
        $this->direccion = $estacion->direccion;
        $this->propietario = $estacion->propietario;
        $this->zona = $estacion->zona_id;
        $this->gerente = $estacion->user_id;
        $this->supervisor = $estacion->supervisor_id;
        $this->status = $estacion->status;
        //llamado a la funcion para obtener los combustibles de la estacion asignada
        $this->combustibles();
        $this->dispensarios();
    }
    public function combustibles()
    { //cargamos los datos de los combustibles asignados a la estacion
        $this->combustibles = [];
        $combustibles = EstacionCombustible::where('estacion_id', $this->estacionID)->orderBy('id', 'DESC')->get();
        foreach ($combustibles as $combustible) {
            array_push($this->combustibles, [
                'id' => $combustible->id,
                'tipo' => $combustible->combustible_id,
                'capacidad' => $combustible->capacidad,
                'prom_venta' => $combustible->prom_venta,
                'dif_vr_fisico' => $combustible->dif_vr_fisico,
                'minimo' => $combustible->minimo,
                'alerta' => $combustible->alerta
            ]);
        }
    }
    public function dispensarios()
    { //cargamos los datos de los dispensarios asignados a la estacion
        $this->dispensarios = [];
        $dispensarios = Dispensario::where('estacion_id', $this->estacionID)->orderBy('id', 'DESC')->get();
        foreach ($dispensarios as $dispensario) {
            array_push($this->dispensarios, [
                'id' => $dispensario->id,
                'marca' => $dispensario->marca,
                'serie' => $dispensario->serie,
                'version_cpu' => $dispensario->version_cpu,
                'modelo' => $dispensario->modelo,
                'mangueras' => $dispensario->mangueras,
                'flujo' => $dispensario->flujo
            ]);
        }
    }
    public function combustibleDelete($id)
    { //Eliminar combustible asignado
        $combustible = EstacionCombustible::find($id);
        $combustible->delete();
        $this->combustibles();
    }
    public function dispensarioDelete($id)
    { //Eliminar dispensario asignado
        $dispensario = Dispensario::find($id);
        $dispensario->delete();
        $this->dispensarios();
    }
    public function estacionUpdate()
    { //Actualizar los datos

        //reglas d evalidacion para datos que  no pueden quedar vacios
        $this->validate(
            [
                'name' => ['required', 'max:250'],
                'numero' => ['required'],
                // 'supervisor' => ['required', 'not_in:0'],
                // 'gerente' => ['required', 'not_in:0'],
                'zona' => ['required', 'not_in:0'],
                'status' => ['required', 'not_in:0'],
            ],
            [
                'name.required' => 'El Nombre de la Estación es obligatorio',
                'name.max' => 'El Nombre de la Estación no debe ser mayor a 250 caracteres',
                'numero.required' => 'El Número de la Estación es obligatorio',
                'zona.required' => 'La Zona es obligatoria',
                'status.required' => 'El Status es obligatorio',
            ]
        );

        //Manejamos la carga con un trycatch
        try {
            $estacion = Estacion::find($this->estacionID);
            $estacion->name = $this->name;
            $estacion->num_estacion = $this->numero;
            $estacion->razon_social = $this->razon;
            $estacion->propietario = $this->propietario;
            $estacion->rfc = $this->rfc;
            $estacion->iva = $this->iva;
            $estacion->siic = $this->siic;
            $estacion->num_cre = $this->cre;
            $estacion->direccion = $this->direccion;
            $estacion->zona_id = $this->zona;
            $estacion->user_id = $this->gerente;
            $estacion->supervisor_id = $this->supervisor;
            $estacion->status = $this->status;
            $estacion->save();
            //actualizamos los datos del combustible actual
            foreach ($this->combustibles as $combustible) {
                $reg = EstacionCombustible::find($combustible['id']);
                $reg->estacion_id = $estacion->id;
                $reg->combustible_id = $combustible['tipo'];
                $reg->capacidad = $combustible['capacidad'];
                $reg->prom_venta = $combustible['prom_venta'];
                $reg->dif_vr_fisico = $combustible['dif_vr_fisico'];
                $reg->minimo = $combustible['minimo'];
                $reg->alerta = $combustible['alerta'];
                // Asignar la clave de acuerdo al tipo de combustible
                switch ($combustible['tipo']) {
                    case 1:
                        $reg->clave = '32025 Gasolina con contenido minimo 87 octanos';
                        break;
                    case 2:
                        $reg->clave = '32026 Gasolina con contenido minimo 91 octanos';
                        break;
                    case 3:
                        $reg->clave = '34015 Diesel Automotriz';
                        break;
                    default:
                        //Manejar caso por defecto o lanzar una excepción si es necesario
                        break;
                }
                $reg->save();
            }
            //guardamos el nuevo combustible
            // dd($this->newCombustibles);
            foreach ($this->newCombustibles as $comb) {
                $reg = new EstacionCombustible();
                $reg->estacion_id = $estacion->id;
                $reg->combustible_id = $comb['tipo'];
                $reg->capacidad = $comb['capacidad'];
                $reg->prom_venta = $comb['prom_venta'];
                $reg->dif_vr_fisico = $comb['dif_vr_fisico'];
                $reg->minimo = $comb['minimo'];
                $reg->alerta = $comb['alerta'];
                // Asignar la clave de acuerdo al tipo de combustible
                switch ($comb['tipo']) {
                    case 1:
                        $reg->clave = '32025 Gasolina con contenido minimo 87 octanos';
                        break;
                    case 2:
                        $reg->clave = '32026 Gasolina con contenido minimo 91 octanos';
                        break;
                    case 3:
                        $reg->clave = '34015 Diesel Automotriz';
                        break;
                    default:
                        //Manejar caso por defecto o lanzar una excepción si es necesario
                        break;
                }
                $reg->save();
            }
            //actualizamos los datos del dispensario actual
            foreach ($this->dispensarios as $dispensario) {
                $reg = Dispensario::find($dispensario['id']);
                $reg->estacion_id = $estacion->id;
                $reg->marca = $dispensario['marca'];
                $reg->serie = $dispensario['serie'];
                $reg->version_cpu = $dispensario['version_cpu'];
                $reg->modelo = $dispensario['modelo'];
                $reg->mangueras = $dispensario['mangueras'];
                $reg->flujo = $dispensario['flujo'];

                $reg->save();
            }
            //guardamos el nuevo dispensario
            foreach ($this->newDispensarios as $disp) {
                $reg = new Dispensario();
                $reg->estacion_id = $estacion->id;
                $reg->marca = $disp['marca'];
                $reg->serie = $disp['serie'];
                $reg->version_cpu = $disp['version_cpu'];
                $reg->modelo = $disp['modelo'];
                $reg->mangueras = $disp['mangueras'];
                $reg->flujo = $disp['flujo'];

                $reg->save();
            }
            session()->flash('flash.banner', 'La información de la estacion ha sido modificada');
            session()->flash('flash.bannerStyle', 'success');
            //volvemos a la direccion que tiene el navegador
            return redirect(request()->header('Referer'));
        } catch (Exception $error) {

            //volvemos a la direccion que tiene el navegador
            return redirect(request()->header('Referer'));
        }
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
        return view('livewire.estacion.estacion-edit');
    }
}
