<?php

namespace App\Http\Livewire\Proveedores;

use App\Models\Proveedor;
use App\Models\Zona;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProveedorEdit extends Component
{
    public $EditProv;
    public $prov_id, $name, $status,$razon_social,$rfc,$direccion,$busqueda,$zonas;
    public $zonasUpdate = [];

    public function resetFilters()
    {
        $this->reset(['name','razon_social','direccion','rfc','busqueda','status']);
    }

    public function mount()
    {
        $this->resetFilters();

        $this->zonasUpdate = [];

        $this->zonas = Zona::where('status', 'Activo')->orderBy('name', 'asc')->get();

        $this->EditProv = false;
    }

    public function confirmProvEdit(int $id)
    {
        $proveedor = Proveedor::where('id', $id)->first();

        $this->prov_id = $id;
        $this->name = $proveedor->name;
        $this->razon_social = $proveedor->razon_social;
        $this->direccion = $proveedor->direccion;
        $this->rfc = $proveedor->rfc;
        $this->busqueda = $proveedor->busqueda;
        $this->status = $proveedor->status;

        $this->EditProv = true;

        $arrayID = [];//Se recopilan los IDs de las zonas asociadas al usuario en un array
        $zonasArray = DB::table('proveedor_zonas')->select('zona_id')->where('proveedor_id', $id)->get();
        foreach ($zonasArray as $zona) { //utilizando una consulta de base de datos y un bucle foreach. Los IDs se almacenan en el atributo $zonasUpdate.

            $arrayID[] = $zona->zona_id;
        }
        $this->zonasUpdate = $arrayID; //Esto se utiliza para mostrar y mantener las zonas seleccionadas por el usuario en el formulario de edición.
    }

    public function EditarProveedor($id)
    {
        $proveedor = Proveedor::where('id', $id)->first();

        $this->validate([
            'name' => ['required', 'max:500'],
            'status' => ['required', 'not_in:0'],
        ],
        [
            'name.required' => 'El Nombre del Proveedor es obligatorio',
            'name.max' => 'El Nombre del Proveedor no debe ser mayor a 500 caracteres',

            'status.required' => 'El Status es obligatorio'
        ]);

        $proveedor->forceFill([
            'name' => $this->name,
            'razon_social' => $this->razon_social,
            'direccion' => $this->direccion,
            'rfc' => $this->rfc,
            'busqueda' => $this->busqueda,
            'status' => $this->status,
        ])->save();

        if (isset($proveedor->zonas)){
            $proveedor->zonas()->sync($this->zonasUpdate);
            }else{
                $proveedor->zonas()->sync(array());
            }

        $this->mount();
    
        session()->flash('flash.banner', 'Proveedor Actualizado, " ' . $proveedor->name . ' " ha sido actualizado en el sistema.');
        session()->flash('flash.bannerStyle', 'success');
        
        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        return view('livewire.proveedores.proveedor-edit');
    }
}
