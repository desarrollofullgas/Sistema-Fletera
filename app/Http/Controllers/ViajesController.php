<?php

namespace App\Http\Controllers;

use App\Models\Cataport;
use App\Models\Estacion;
use App\Models\RecepcionPipa;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViajesController extends Controller
{
    public function home(){
        $user=Auth::user();
        $valid = Auth::user()->permiso->panels->where('id',13)->first();//validamos las opciones en Viajes que tiene acceso el usuario
        //administradores
        if(in_array($user->permiso_id,[1,4])){
            $viajes=Cataport::orderBy('id','DESC')->paginate(15);
        //supervisores
        }elseif($user->permiso_id==2){
            $estaciones=Estacion::where('supervisor_id',$user->id)->pluck('id');
            $viajes=Cataport::whereIn('estacion_id',$estaciones)->orderBy('id','DESC')->paginate(15);
        //gerentes
        }elseif($user->permiso_id==3){
            $estacion=Estacion::where('user_id',$user->id)->pluck('id');
            $viajes=Cataport::whereIn('estacion_id',$estacion)->orderBy('id','DESC')->paginate(15);
        }
        return view('modules.viajes.index',compact('viajes','valid'));
    }
    public function buscarViaje(Request $request){
        $user=Auth::user();
        $valid = Auth::user()->permiso->panels->where('id',13)->first();//validamos las opciones en Viajes que tiene acceso el usuario
        //query para administradores
        if (in_array($user->permiso_id,[1,4])) {
            if(!is_null($request->query('start')) && !is_null($request->query('end'))){
                $rango=[Carbon::create($request->query('start'))->startOfDay()->toDateTimeString(),Carbon::create($request->query('end'))->endOfDay()->toDateTimeString()];
                $viajes=Cataport::where('id',$request->query('search'))->orWhereHas('estacion',function(Builder $estaciones)use($request){
                    $estaciones->where('name','LIKE','%'.$request->query('search').'%');
                })->whereBetween('created_at',$rango)->orderBy('id','DESC')->paginate(15)->withQueryString();
            }
            else{
                $viajes=Cataport::where('id',$request->query('search'))->orWhereHas('estacion',function(Builder $estaciones)use($request){
                    $estaciones->where('name','LIKE','%'.$request->query('search').'%');
                })->orderBy('id','DESC')->paginate(15)->withQueryString();
            }
        //supervisores
        } elseif($user->permiso_id==2) {
            $estaciones=Estacion::where('supervisor_id',$user->id)->pluck('id');
            if(!is_null($request->query('start')) && !is_null($request->query('end'))){
                $rango=[Carbon::create($request->query('start'))->startOfDay()->toDateTimeString(),Carbon::create($request->query('end'))->endOfDay()->toDateTimeString()];
                $viajes=Cataport::where('id',$request->query('search'))->orWhereHas('estacion',function(Builder $estaciones)use($request){
                    $estaciones->where('name','LIKE','%'.$request->query('search').'%');
                })->whereIn('estacion_id',$estaciones)->whereBetween('created_at',$rango)->orderBy('id','DESC')->paginate(15)->withQueryString();
            }else{
                $viajes=Cataport::where('id',$request->query('search'))->orWhereHas('estacion',function(Builder $estaciones)use($request){
                    $estaciones->where('name','LIKE','%'.$request->query('search').'%');
                })->whereIn('estacion_id',$estaciones)->orderBy('id','DESC')->paginate(15)->withQueryString();
            }
        //gerentes
        }elseif($user->permiso_id){
            $estacion=Estacion::where('user_id',$user->id)->pluck('id');
            if(!is_null($request->query('start')) && !is_null($request->query('end'))){
                $rango=[Carbon::create($request->query('start'))->startOfDay()->toDateTimeString(),Carbon::create($request->query('end'))->endOfDay()->toDateTimeString()];
                $viajes=Cataport::where('id',$request->query('search'))->whereIn('estacion_id',$estacion)->whereBetween('created_at',$rango)->orderBy('id','DESC')->paginate(15)->withQueryString();
            }else{
                $viajes=Cataport::where('id',$request->query('search'))->whereIn('estacion_id',$estacion)->orderBy('id','DESC')->paginate(15)->withQueryString();
            }
        }
        return view('modules.viajes.index',compact('viajes','valid'));
    }
    //PDF del cataporte
    public function pdf($id){
        $cataporte=Cataport::find($id);
        //$cataporte->created_at=Carbon::create($cataporte->created_at)->toDateString();
        $pdf=Pdf::loadView('modules.viajes.PDF',compact('cataporte'))->stream();
        return $pdf;
    }
    //recepcion de pipas
    public function recepcionesHome(){
        $recepciones=RecepcionPipa::orderBy('id','DESC')->paginate(10);
        $valid = Auth::user()->permiso->panels->where('id',14)->first();//validamos las opciones que tiene acceso el usuario
        return view('modules.recepcion.index',compact('recepciones','valid'));
    }
    public function recepcionPDF($id){
        $recepcion=RecepcionPipa::find($id);
        $pdf=Pdf::loadView('modules.recepcion.PDF',compact('recepcion'))->stream();
        return $pdf;
    }
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
