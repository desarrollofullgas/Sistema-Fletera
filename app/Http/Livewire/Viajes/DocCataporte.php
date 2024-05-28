<?php

namespace App\Http\Livewire\Viajes;

use App\Models\Cataport;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class DocCataporte extends Component
{
    public $viajeID;
    public function viewPDF($ct){
        $cataporte=Cataport::find($ct);
        $pdf=Pdf::loadView('modules.viajes.PDF',compact('cataporte'))->stream('Cataporte.pdf');
        return $pdf;
        //return response()->stream(fn()=>print($pdf),'Cataporte.pdf');
    }
    public function render()
    {
        return view('livewire.viajes.doc-cataporte');
    }
}
