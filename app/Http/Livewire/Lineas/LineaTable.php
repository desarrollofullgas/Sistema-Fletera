<?php

namespace App\Http\Livewire\Lineas;

use App\Exports\LineasExport;
use App\Models\Linea;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class LineaTable extends Component
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

    public function render()
    {
        $this->valid = Auth::user()->permiso->panels->where('id', 8)->first();
        return view('livewire.lineas.linea-table', [
            'trashed' => Linea::onlyTrashed()->count(),
            'lineas' => $this->lineas,
        ]);
    }

    //Cycle Hooks
    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->lineas->pluck('id');
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
        $this->checked = $this->lineasQuery->pluck('id');
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
    public function getLineasProperty()
    {
        return  $this->lineasQuery->paginate($this->perPage);
    }

    public function getLineasQueryProperty()
    {
        return Linea::search($this->search)
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
        return (new LineasExport($this->checked))->download('LINEAS.xlsx');
    }

    //Eliminación multiple
    public function deleteLineas()
    {
        Linea::whereKey($this->checked)->delete();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        session()->flash('flash.banner', 'ELIMINADO, la inea transportista ha sido eliminada del sistema.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(request()->header('Referer'));
    }
}
