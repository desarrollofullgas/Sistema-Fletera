<?php

namespace App\Http\Controllers;

use App\Models\Lectura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valid = Auth::user()->permiso->panels->where('id', 2)->first();//provisional, cambiar luego
        $trashed = Lectura::onlyTrashed()->count();

        if (Auth::user()->permiso->id == 1) {
            return view('modules.lecturas.index', ['valid' => $valid, 'trashed' => $trashed]);
        } elseif ($valid->pivot->re == 1) {
            return view('modules.lecturas.index', ['valid' => $valid, 'trashed' => $trashed]);
        } else {
            return redirect()->route('dashboard');
        }
    }

  
    public function trashed_lecturas()
    {
        $valid = Auth::user()->permiso->panels->where('id', 2)->first();

        $trashed = Lectura::onlyTrashed()->orderBy("id", "desc")->paginate();

        return view("modules.lecturas.lecturastrashed", [
            "trashed" => $trashed,
            "valid" => $valid,
        ]);
    }

    public function do_restore()
    {
        $lectura = Lectura::withTrashed()->find(request()->id);
        if ($lectura == null) {
            abort(404);
        }

        $lectura->restore();
        return redirect()->back();
    }

    public function delete_permanently()
    {
        $lectura = Lectura::withTrashed()->find(request()->id);
        if ($lectura == null) {
            abort(404);
        }

        $lectura->forceDelete();
        return redirect()->back();
    }
}
