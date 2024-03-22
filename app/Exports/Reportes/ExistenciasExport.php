<?php

namespace App\Exports\Reportes;

use App\Exports\Reportes\Sheets\ExistenciasSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExistenciasExport implements WithMultipleSheets
{
    /**
     * Constructor de la clase.
     *
     * @param array $estaciones Un array con los id's de las estaciones.
     * @param array $rango Un array con la fecha de inicio y fin
     */
    public $estaciones,$rango;
    public function __construct($estaciones,array $rango) {
        $this->estaciones = $estaciones;
        $this->rango = $rango;
    }
   public function sheets(): array
   {
    $arr=[];
    array_push($arr,new ExistenciasSheet($this->estaciones,$this->rango));
    return $arr;
   }
}
