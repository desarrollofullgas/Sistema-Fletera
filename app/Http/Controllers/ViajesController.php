<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViajesController extends Controller
{
    public function home(){
        return view('modules.viajes.index');
    }
}
