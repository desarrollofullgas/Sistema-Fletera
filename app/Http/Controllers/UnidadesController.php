<?php

namespace App\Http\Controllers;

use App\Models\Linea;
use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadesController extends Controller
{
    public function home(){
        $unidades=Unidad::orderBy('tractor')->paginate(10);
        return view('modules.unidades.index',compact('unidades'));
    }
    public function lineasHome(){
        $lineas=Linea::paginate(10);
        return view('modules.lineas.index',compact('lineas'));
    }
    public function editUnidad($id){
        $unidadID=$id;
        return view('modules.unidades.edit',compact('unidadID'));
    }
}
