<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $valid = Auth::user()->permiso->panels->where('id', 7)->first();
        $trashed = Proveedor::onlyTrashed()->count();

        if (Auth::user()->permiso->id == 1) {
            return view('modules.proveedores.index', ['valid' => $valid, 'trashed' => $trashed]);
        } elseif ($valid->pivot->re == 1) {
            return view('modules.proveedores.index', ['valid' => $valid, 'trashed' => $trashed]);
        } else {
            return redirect()->route('dashboard');
        }
    }

  
    public function trashed_proveedores()
    {
        $valid = Auth::user()->permiso->panels->where('id', 7)->first();

        $trashed = Proveedor::onlyTrashed()->orderBy("id", "desc")->paginate();

        return view("modules.proveedores.proveedortrashed", [
            "trashed" => $trashed,
            "valid" => $valid,
        ]);
    }

    public function do_restore()
    {
        $proveedor = Proveedor::withTrashed()->find(request()->id);
        if ($proveedor == null) {
            abort(404);
        }

        $proveedor->restore();
        return redirect()->back();
    }

    public function delete_permanently()
    {
        $proveedor = Proveedor::withTrashed()->find(request()->id);
        if ($proveedor == null) {
            abort(404);
        }

        $proveedor->forceDelete();
        return redirect()->back();
    }
}
