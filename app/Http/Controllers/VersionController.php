<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Backup\Tasks\Backup\BackupDestination;
use Spatie\Backup\Tasks\Backup\BackupJob;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use Spatie\Backup\BackupDestination\BackupDestinationFactory;

class VersionController extends Controller
{
    public function show()
    {
        $valid = Auth::user()->permiso->panels->where('id', 10)->first();

        if (Auth::user()->permiso->id == 1) {
            return view('modules.sistema.versiones.index', ['val' => $valid]);
        } elseif ($valid->pivot->re == 1) {
            return view('modules.sistema.versiones.index', ['val' => $valid]);
        } else {
            return redirect()->route('dashboard');
        }
    }
}
