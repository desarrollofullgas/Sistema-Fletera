<?php

namespace App\Http\Livewire\Lecturas;

use App\Models\Estacion;
use App\Models\Lectura;
use App\Models\LecturaDetalle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LecturaTable extends Component
{
    use WithPagination;

    public $valid;
    public $search = '';
    public $sortField;
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $from_date = "";
    public $to_date = "";
    public $checked = [];
    public $selectPage = false;
    public $selectAll = false;

    public function render()
    {
        $this->valid = Auth::user()->permiso->panels->where('id', 10)->first();
        return view('livewire.lecturas.lectura-table', [
            'trashed' => Lectura::onlyTrashed()->count(),
            'lecturas' => $this->lecturas,
        ]);
    }

    //Cycle Hooks
    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->lecturas->pluck('id');
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
        $this->checked = $this->lecturasQuery->pluck('id');
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
    public function getLecturasProperty()
    {
        return  $this->lecturasQuery->paginate($this->perPage);
    }

    public function getLecturasQueryProperty()
    {
        $user = Auth::user();
        return Lectura::search($this->search)
            ->when($user->permiso_id == 1  || $user->permiso_id == 4, function ($query) {
                // Si el usuario es un administrador, no aplicamos restricciones
                return $query;
            }, function ($query) use ($user) {
                if ($user->permiso_id == 2) {
                    // Obtener los IDs de las estaciones supervisadas por el usuario autenticado
                    $estacion = Estacion::where('supervisor_id', Auth::user()->id)->pluck('id')->toArray(); // Obtener la estación del usuario actual
                    $query->where(function ($subQuery) use ($estacion) {
                        $subQuery->whereIn('combustible_id', function ($subquery) use ($estacion) {
                            $subquery->select('id')
                                ->from('combustibles')
                                ->whereIn('estacion_id', $estacion); // Acceder al ID de la estación
                        });
                    });
                } else {
                    // Si el usuario es un gerente, filtramos por sus estaciones asignadas
                    $estacion = Estacion::where('user_id', Auth::user()->id)->first(); // Obtener la estación del usuario actual
                    $query->where(function ($subQuery) use ($estacion) {
                        $subQuery->whereIn('combustible_id', function ($subquery) use ($estacion) {
                            $subquery->select('id')
                                ->from('combustibles')
                                ->where('estacion_id', $estacion->id); // Acceder al ID de la estación
                        });
                    });
                }
            })
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
    //   public function exportSelected()
    //   {
    //       return (new EstacionExport($this->checked))->download('ESTACIONES.xlsx');
    //   }

    //Eliminación multiple
    public function deleteLecturas()
    {
        Lectura::whereKey($this->checked)->delete();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        session()->flash('flash.banner', 'ELIMINADO, la estación ha sido eliminada del sistema.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(request()->header('Referer'));
    }
}
