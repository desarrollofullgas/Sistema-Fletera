<?php

namespace App\Exports\Reportes\Sheets;

use App\Models\Combustible;
use App\Models\Estacion;
use App\Models\Lectura;
use App\Models\LecturaDetalle;
use App\Models\Zona;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExistenciasSheet implements FromView,ShouldAutoSize,WithTitle,WithEvents
{
    public $estaciones,$rango;
    public function __construct($estaciones,array $rango) {
        $this->estaciones = $estaciones;
        $this->rango = $rango;
    }
    public function view(): View
    {
        $tablas=[];
        //Obtenemos las zonas cuyas estaciones tengan registradas lecturas de sus combustibles
        $zonas=Zona::whereHas('estacions',function(Builder $estaciones){
            $estaciones->whereHas('combustibles',function(Builder $combustibles){
                $combustibles->whereHas('detalleLectura',function(Builder $detalleLectura){
                    $detalleLectura->whereBetween('created_at',$this->rango);
                });
            });
        })->orderBy('name','ASC')->get();
        //$mainLecturas=Lectura::whereBetween('created_at',$this->rango)->get();
        $estaciones=Estacion::whereIn('id',$this->estaciones)->get();
        foreach($zonas as $zona){
            foreach($estaciones as $estacion){
                //si la estación pertenece a la zona
                if($estacion->zona_id == $zona->id){
                    $dataLecturas=[];
                    //obtenemos las lecturas de los combustibles de la estación que fueron registradas en el rango de fechas
                    $mainLecturas=Lectura::whereHas('detalles',function(Builder $detalle)use($estacion){
                        $detalle->whereIn('combustible_id',$estacion->combustibles->pluck('id'));
                    })->get();
                    $listComb=Combustible::select('tipo')->where('estacion_id',$estacion->id)->groupBy('tipo')->get();
                    //dd($mainLecturas->pluck('id'),$estacion->name);
                    foreach($mainLecturas as $mainLect){
                        $tabla=[];
                        $com12=[];
                        //obtenemos los detalles e información adicional de la lectura
                        $lecturas=LecturaDetalle::selectRaw('*,((veeder+fisico)/2) as exist')->where('lectura_id',$mainLect->id)->get();
                        $copia=$lecturas;
                        foreach ($lecturas as $lect)
                        {
                            $c=1;//variable para poder definir el promedio
                            $exisTot=$lect->exist;
                            $capacidadTot=$lect->combustible->capacidad;
                            $dias=$lect->combustible->alerta;
                            $minimo=$lect->combustible->minimo;
                            $promedio=$lect->combustible->prom_venta;
                            /* Operacio para agrupar y sacar promedios en caso que una estación tenga resgistrado 2
                            o más combustibles del mismo tipo MM-P M-PP DD-M-P .... */
                            foreach($copia as $bk)
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
                                'lectura_id'=>$lect->lectura_id,
                                'combustible'=>$lect->combustible->tipo,
                                'existencia'=>$exisTot,
                                'llenar'=>($exisTot-$capacidadTot),
                                'dias'=>$minimo==0||$promedio==0 ? 0 : (($exisTot-($minimo/$c))/($promedio/$c))
                            ]); 
                        }
                        array_push($dataLecturas,['lecturas'=>$com12,'creado'=>$mainLect->created_at]);
                    }
                    array_push($tablas,['estacion'=>$estacion->name,'data'=>$dataLecturas,'combustibles'=>$listComb,'zona'=>$estacion->zona->name]);
                }
            }
        }
        /* foreach($this->estaciones as $estacion) 
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
            array_push($tablas,['estacion'=>$est->name,'data'=>$com12,'combustibles'=>$combustibles,'zona'=>$est->zona_id]);
        } */
        //dd($tablas,$zonas);
        return view('excels.reportes.existencias.existencias',compact('tablas','zonas'));
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class=>function(AfterSheet $event){
                $cabeceras=$event->sheet->getDelegate()->getMergeCells();
                $celdas=$event->sheet->getDelegate()->getCellCollection()->getCoordinates();
                foreach($celdas as $celda){
                    $event->sheet->getDelegate()->getStyle($celda)->applyFromArray([
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['argb' => 'ff000000'],
                            ]
                        ]
                    ]);
                }
                foreach($cabeceras as $cabecera){
                    $event->sheet->getDelegate()->getStyle($cabecera)
                    ->applyFromArray([
                        'font' => [
                            'size'=>12,
                            'bold' => true,
                            'color' => ['rgb' => 'ffffff'],
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'color' => ['argb' => '000000'],
                        ],
                    ]);
                }
            }
        ];
    }
    public function title(): string
    {
        return 'Existencias';
    }
}
