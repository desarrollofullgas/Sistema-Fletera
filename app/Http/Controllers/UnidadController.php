<?php

namespace App\Http\Controllers;

use App\Models\Linea;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnidadController extends Controller
{
    //Unidades
    public function index(){
        $valid = Auth::user()->permiso->panels->where('id', 9)->first();
        $trashed = Unidad::onlyTrashed()->count();

        if (Auth::user()->permiso->id == 1) {
            return view('modules.unidades.index', ['valid' => $valid, 'trashed' => $trashed]);
        } elseif ($valid->pivot->re == 1) {
            return view('modules.unidades.index', ['valid' => $valid, 'trashed' => $trashed]);
        } else {
            return redirect()->route('dashboard');
        }
    }
    public function trashed_unidades()
    {
        $valid = Auth::user()->permiso->panels->where('id', 9)->first();

        $trashed = Unidad::onlyTrashed()->orderBy("id", "desc")->paginate();

        return view("modules.unidades.unidadestrashed", [
            "trashed" => $trashed,
            "valid" => $valid,
        ]);
    }

    public function do_restore()
    {
        $unidad = Unidad::withTrashed()->find(request()->id);
        if ($unidad == null) {
            abort(404);
        }

        $unidad->restore();
        return redirect()->back();
    }

    public function delete_permanently()
    {
        $unidad = Unidad::withTrashed()->find(request()->id);
        if ($unidad == null) {
            abort(404);
        }

        $unidad->forceDelete();
        return redirect()->back();
    }

    //Lineas de Transporte
    public function lineasIndex(){
        $valid = Auth::user()->permiso->panels->where('id', 8)->first();
        $trashed = Linea::onlyTrashed()->count();

        if (Auth::user()->permiso->id == 1) {
            return view('modules.lineas.index', ['valid' => $valid, 'trashed' => $trashed]);
        } elseif ($valid->pivot->re == 1) {
            return view('modules.lineas.index', ['valid' => $valid, 'trashed' => $trashed]);
        } else {
            return redirect()->route('dashboard');
        }
    }
    public function trashed_lineas()
    {
        $valid = Auth::user()->permiso->panels->where('id', 8)->first();

        $trashed = Linea::onlyTrashed()->orderBy("id", "desc")->paginate();

        return view("modules.lineas.lineatrashed", [
            "trashed" => $trashed,
            "valid" => $valid,
        ]);
    }

    public function do_restoreL()
    {
        $linea = Linea::withTrashed()->find(request()->id);
        if ($linea == null) {
            abort(404);
        }

        $linea->restore();
        return redirect()->back();
    }

    public function delete_permanentlyL()
    {
        $linea = Linea::withTrashed()->find(request()->id);
        if ($linea == null) {
            abort(404);
        }

        $linea->forceDelete();
        return redirect()->back();
    }
    
}
