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
            $est=Estacion::find($estacion);
            $combustibles=Combustible::where('estacion_id',$estacion)->get();
            $lecturas=LecturaDetalle::selectRaw('*,((veeder+fisico)/2) as exist')->whereIn('combustible_id',$combustibles->pluck('id'))->whereBetween('created_at',$this->rango)->get();
            $copia=$lecturas;
            foreach ($lecturas as $key=>$lect)
            {
                $c=1;//variable para poder definir el promedio
                $exisTot=$lect->exist;
                $capacidadTot=$lect->combustible->capacidad;
                $dias=$lect->combustible->alerta;
                $minimo=$lect->combustible->minimo;
                $promedio=$lect->combustible->prom_venta;
                foreach($copia as $key=>$bk)
                {
                    if($lect->combustible->tipo == $bk->combustible->tipo && $lect->id!== $bk->id)
                    {
                        $c++;
                        $exisTot+=$bk->exist;
                        $capacidadTot+=$bk->combustible->capacidad;
                        $minimo+=$bk->combustible->minimo;
                        $dias+=$bk->combustible->alerta;
                        $promedio+=$bk->combustible->prom_venta;
                    }
                }
                array_push($com12,[
                    'combustible'=>$lect->combustible->tipo,
                    'existencia'=>$exisTot,
                    'llenar'=>($exisTot-$capacidadTot),
                    'dias'=>$minimo==0||$promedio==0 ? 0 : (($exisTot-($minimo/$c))/($promedio/$c)),
                    'creado'=>$lect->created_at
                ]); 
            }
            array_push($tablas,[$est->name => $com12,'combustibles'=>$combustibles,'zona'=>$est->zona_id]);
        }
        dd($tablas);
        return view('excels.reportes.existencias.existencias',compact('tablas'));
    }
}
