<?php

namespace App\Http\Livewire\Proveedores;

use App\Exports\ProveedorExport;
use App\Models\Proveedor;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ProveedorTable extends Component
{
    use WithPagination;

    public $valid;
    public $search = '';
    public $sortField;
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $from_date = "";
    public $to_date = "";
    public $checked = [];
    public $selectPage = false;
    public $selectAll = false;

    public $showingAllZonas = false;
    public $selectedProveedorId;
    public $allZonas = [];

    public function render()
    {
        $this->valid = Auth::user()->permiso->panels->where('id', 7)->first();

        return view('livewire.proveedores.proveedor-table', [
            'trashed' => Proveedor::onlyTrashed()->count(),
            'proveedores' => $this->proveedores,
        ]);
    }

    //Cycle Hooks
    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->proveedores->pluck('id');
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        $this->selectPage = false;
    }

    public function selectAll()
    {
        $this->selectAll = true;
        $this->checked = $this->proveedoresQuery->pluck('id');
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function clearDateFilters()
    {
        $this->from_date = '';
        $this->to_date = '';
        $this->resetPage(); // Opcional: reinicia la paginación si es necesario
    }

    //Obtener los datos y paginación
    public function getProveedoresProperty()
    {
        return  $this->proveedoresQuery->paginate($this->perPage);
    }

    public function getProveedoresQueryProperty()
    {
        return Proveedor::search($this->search)
            ->when($this->sortField, function ($query) {
                return $query->orderBy($this->sortField, $this->sortDirection);
            })
            ->when($this->from_date && $this->to_date, function ($query) {
                return $query->whereBetween('created_at', [$this->from_date, $this->to_date . " 23:59:59"]);
            });
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc' : 'asc';

        $this->sortField = $field;
    }

    //Exportar a excel
    public function exportSelected()
    {
        return (new ProveedorExport($this->checked))->download('PROVEEDORES.xlsx');
    }

    //Eliminación multiple
    public function deleteProveedores()
    {
        Proveedor::whereKey($this->checked)->delete();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        session()->flash('flash.banner', 'ELIMINADO, el proveedor ha sido eliminado del sistema.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(request()->header('Referer'));
    }

    public function getAllZonas($proveedorId)
    {
        $this->selectedProveedorId = $proveedorId;
        $proveedor = Proveedor::findOrFail($proveedorId);
        $this->allZonas = $proveedor->zonas ?? []; // Verificar si $proveedor->zonas es null y asignar un array vacío en ese caso
        $this->showingAllZonas = true;
    }
}
