<?php

namespace App\Http\Controllers;

use App\Models\Cataport;
use Illuminate\Http\Request;

class ViajesController extends Controller
{
    public function home(){
        $viajes=Cataport::orderBy('id','DESC')->paginate(10);
        return view('modules.viajes.index',compact('viajes'));
    }
}
