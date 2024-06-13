<?php

namespace App\Exports\Reportes;

use App\Exports\Reportes\Sheets\VentasSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class VentasExport implements WithMultipleSheets
{
    public $estaciones,$rango;
    public function __construct($estaciones, Array $rango) {
        $this->estaciones = $estaciones;
        $this->rango = $rango;
    }
    public function sheets(): array
    {
        $arr=[];
        foreach($this->estaciones as $id){
            array_push($arr,new VentasSheet($id,$this->rango));
        }
        return $arr;
    }
}