<?php

namespace App\Http\Controllers;

use App\Models\Operador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $valid = Auth::user()->permiso->panels->where('id', 7)->first();
        $trashed = Operador::onlyTrashed()->count();

        if (Auth::user()->permiso->id == 1) {
            return view('modules.operadores.index', ['valid' => $valid, 'trashed' => $trashed]);
        } elseif ($valid->pivot->re == 1) {
            return view('modules.operadores.index', ['valid' => $valid, 'trashed' => $trashed]);
        } else {
            return redirect()->route('dashboard');
        }
    }

  
    public function trashed_operadores()
    {
        $valid = Auth::user()->permiso->panels->where('id', 7)->first();

        $trashed = Operador::onlyTrashed()->orderBy("id", "desc")->paginate();

        return view("modules.operadores.operadortrashed", [
            "trashed" => $trashed,
            "valid" => $valid,
        ]);
    }

    public function do_restore()
    {
        $operador = Operador::withTrashed()->find(request()->id);
        if ($operador == null) {
            abort(404);
        }

        $operador->restore();
        return redirect()->back();
    }

    public function delete_permanently()
    {
        $operador = Operador::withTrashed()->find(request()->id);
        if ($operador == null) {
            abort(404);
        }

        $operador->forceDelete();
        return redirect()->back();
    }
}
