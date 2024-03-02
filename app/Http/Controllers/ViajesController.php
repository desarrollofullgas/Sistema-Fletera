<?php

namespace App\Http\Controllers;

use App\Models\Cataport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViajesController extends Controller
{
    public function home(){
        $viajes=Cataport::orderBy('id','DESC')->paginate(10);
        return view('modules.viajes.index',compact('viajes'));
    }
    //PDF del cataporte
    public function pdf($id){
        $cataporte=Cataport::find($id);
        //$cataporte->created_at=Carbon::create($cataporte->created_at)->toDateString();
        $pdf=Pdf::loadView('modules.viajes.PDF',compact('cataporte'))->stream();
        return $pdf;
    }
    //recepcion de pipas
    public function recepcion($id){
        $viaje=Cataport::find($id);
        return view('modules.recepcion.new-recepcion',compact('viaje'));
    }
    //editar recepcion de pipa
    public function editRecepcion($id){
        $viaje=Cataport::find($id);
        return view('modules.recepcion.edit-recepcion',compact('viaje'));
    }
}
