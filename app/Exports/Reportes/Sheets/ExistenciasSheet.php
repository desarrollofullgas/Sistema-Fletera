<?php

namespace App\Exports\Reportes\Sheets;

use App\Models\Combustible;
use App\Models\Estacion;
use App\Models\EstacionCombustible;
use App\Models\Lectura;
use App\Models\LecturaDetalle;
use App\Models\Zona;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
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
            $estaciones->whereHas('lecturas',function(Builder $lecturas){
                $lecturas->whereBetween('created_at',$this->rango);
            });
        })->orderBy('name','ASC')->get();
        //$mainLecturas=Lectura::whereBetween('created_at',$this->rango)->get();
        $estaciones=Estacion::whereIn('id',$this->estaciones)->get();
        foreach($zonas as $zona){
            foreach($estaciones as $estacion){
                //si la estación pertenece a la zona
                if($estacion->zona_id == $zona->id){
                    $dataLecturas=[];
                    //obtenemos las lecturas de la estación que fueron registradas en el rango de fechas
                    $mainLecturas=Lectura::where('estacion_id',$estacion->id)->whereBetween('created_at',$this->rango)->get();
                    $listComb=Combustible::all();
                    /* $listComb=Combustible::select('tipo')->whereHas('info',function(Builder $info)use($estacion){
                        $info->where('estacion_id',$estacion->id);
                    })->groupBy('tipo')->get(); */
                    foreach($mainLecturas as $mainLect){
                        $tabla=[];
                        $com12=[];
                        $dataRow=[];
                        $arr=[
                            'MAGNA'=>['existencia'=>0,'llenar'=>0,'dias'=>0],
                            'PREMIUM'=>['existencia'=>0,'llenar'=>0,'dias'=>0],
                            'DIESEL'=>['existencia'=>0,'llenar'=>0,'dias'=>0]
                        ];
                        //obtenemos los detalles e información adicional de la lectura
                        //$lecturas=LecturaDetalle::selectRaw('combustible_id,AVG(veeder) as v,AVG(fisico) as f,AVG(venta_periferico) as pf,AVG(venta_electronica) as vl,AVG(venta_odometro) as vd,AVG(((veeder+fisico)/2)) as exist')->where('lectura_id',$mainLect->id)->groupBy('combustible_id')->get();
                        //<---------- Combustibles de manera general------------ V2.1>
                        //$lecturas=DB::table('combustibles as c')->join('lectura_detalles as ld','c.id','=','ld.combustible_id')->join('estacion_combustibles as ec','c.id','=','ec.combustible_id')->where('ld.lectura_id',$mainLect->id)->selectRaw('c.tipo,SUM(((ld.veeder+ld.fisico)/2)) as exist,SUM(ec.capacidad) as cp,SUM(ec.prom_venta) as pv,SUM(ec.minimo) as min,Sum(ec.alerta) as dias')->groupBy('c.tipo','ld.combustible_id')->get();
                        //<---------- Combustibles por tanque ------------------ V2.2>
                        $lecturas=DB::table('estacion_combustibles as ec')->join('lectura_detalles as ld','ec.id','=','ld.estacion_combustible_id')->join('combustibles as c','ec.combustible_id','=','c.id')->where('ld.lectura_id',$mainLect->id)->selectRaw('c.tipo,SUM(((ld.veeder+ld.fisico)/2)) as exist,SUM(ec.capacidad) as cp,SUM(ec.prom_venta) as pv,SUM(ec.minimo) as min,Sum(ec.alerta) as dias')->groupBy('c.tipo','ec.combustible_id')->get();
                       
                        foreach($lecturas as $lect){
                            switch ($lect->tipo) {
                                case 'MAGNA':
                                    $arr['MAGNA']['existencia']=$lect->exist;
                                    $arr['MAGNA']['llenar']=($lect->exist - $lect->cp);
                                    $arr['MAGNA']['dias']=$lect->min==0 || $lect->pv ==0 ? 0 : (($lect->exist - $lect->min)/$lect->pv);
                                    break;
                                
                                case 'PREMIUM':
                                    $arr['PREMIUM']['existencia']=$lect->exist;
                                    $arr['PREMIUM']['llenar']=($lect->exist - $lect->cp);
                                    $arr['PREMIUM']['dias']=$lect->min==0 || $lect->pv ==0 ? 0 : (($lect->exist - $lect->min)/$lect->pv);
                                    break;
                                case 'DIESEL':
                                    $arr['DIESEL']['existencia']=$lect->exist;
                                    $arr['DIESEL']['llenar']=($lect->exist - $lect->cp);
                                    $arr['DIESEL']['dias']=$lect->min==0 || $lect->pv ==0 ? 0 : (($lect->exist - $lect->min)/$lect->pv);
                                    break;
                            }
                        }
                        /* foreach ($lecturas as $lect)
                        {
                            $c=1;//variable para poder definir el promedio
                            $exisTot=$lect->exist;
                            $capacidadTot=$lect->combustible->capacidad;
                            $dias=$lect->combustible->alerta;
                            $minimo=$lect->combustible->minimo;
                            $promedio=$lect->combustible->prom_venta;
                            //Operacio para agrupar y sacar promedios en caso que una estación tenga resgistrado 2
                            //o más combustibles del mismo tipo MM-P M-PP DD-M-P ....
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
                                'lectura_id'=>$mainLect->id,
                                'combustible'=>$lect->combustible->tipo,
                                'existencia'=>$exisTot,
                                'llenar'=>($exisTot-$capacidadTot),
                                'dias'=>$minimo==0||$promedio==0 ? 0 : (($exisTot-($minimo/$c))/($promedio/$c))
                            ]); 
                        } */
                        array_push($dataLecturas,['lecturas'=>$arr,'creado'=>$mainLect->created_at]);
                    }
                    array_push($tablas,['estacion'=>$estacion->name,'data'=>$dataLecturas,'combustibles'=>$listComb,'zona'=>$estacion->zona->name]);
                }
            }
        }
        
        //dd($tablas);
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
                /* foreach($cabeceras as $cabecera){
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
                } */
            }
        ];
    }
    public function title(): string
    {
        return 'Existencias';
    }
}
