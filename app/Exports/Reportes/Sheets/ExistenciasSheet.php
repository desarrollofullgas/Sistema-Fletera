<?php

namespace App\Exports\Reportes\Sheets;

use App\Models\Combustible;
use App\Models\Estacion;
use App\Models\LecturaDetalle;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ExistenciasSheet implements FromView
{
    public $estaciones,$rango;
    public function __construct($estaciones,array $rango) {
        $this->estaciones = $estaciones;
        $this->rango = $rango;
    }
    public function view(): View
    {
        $tablas=[];
        /* obtenemos la cantidad de combustibles que tiene cada estación y los ordenamos de mayor a menor, 
        esto para las columnas de la tabla*/
        //$cobustibles=Combustible::selectRaw('estacion_id,tipo,COUNT(*) as cant')->whereIn('estacion_id',$this->estaciones)->orderBy('tipo','ASC')->orderBy('cant','DESC')->groupBy('estacion_id','tipo')->get();
        
        foreach($this->estaciones as $estacion)
        {
            $tabla=[];
            $com12=[];
            $combustibles=Combustible::where('estacion_id',$estacion)->get();
            $lecturas=LecturaDetalle::selectRaw('*,((veeder+fisico)/2) as exist')->whereIn('combustible_id',$combustibles->pluck('id'))->whereBetween('created_at',$this->rango)->get();
            $copia=$lecturas;
            foreach ($lecturas as $key=>$lect)
            {
                $exisTot=$lect->exist;
                foreach($copia as $key=>$bk)
                {
                    if($lect->combustible->tipo == $bk->combustible->tipo && $lect->id!== $bk->id)
                    {
                        $exisTot+=$bk->exist;
                    }
                }
                array_push($com12,$exisTot); 
            }
            array_push($tablas,[Estacion::find($estacion)->name =>$com12]);
        }
        dd($tablas);
        return view();
    }
}
