<?php

namespace App\Exports\Reportes\Sheets;

use App\Models\Combustible;
use App\Models\Estacion;
use App\Models\EstacionCombustible;
use App\Models\Lectura;
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

class VentasSheet implements FromView,WithTitle,ShouldAutoSize,WithEvents
{
    public $rango,$id,$estacion;
    public function __construct($id,Array $rango) {
        $this->rango = $rango;
        $this->id = $id;
    }
    public function view(): View
    {
        //$estacion=Estacion::find($this->id);
        /* $combustibles=Combustible::whereHas('info',function(Builder $info)use($estacion){
            $info->where('estacion_id',$estacion->id);
        })->get(); */
        $table=[];
        $combustibles=EstacionCombustible::where('estacion_id',$this->id)->get();
        $lecturas=Lectura::where('estacion_id',$this->id)->whereHas('detalles',function(Builder $detalle)use($combustibles){
            $detalle->whereIn('estacion_combustible_id',$combustibles->pluck('id'));
        })->whereBetween('created_at',$this->rango)->orderBy('id','DESC')->get();
        //generamos el template de la fila de la tabla a pintar en el excel
        $data=$combustibles->map(function($combustible){
            return ['id'=>$combustible->id,'value'=>0,'odo'=>0];
        });

        //asignamos los valores al array que se usara como template
        foreach($lecturas as $lectura){
            array_push($table,[
                'fecha'=>$lectura->created_at,
                'total'=>$lectura->total_litros,
                'fila'=>$data->map(function($row) use ($lectura){
                    foreach($lectura->detalles as $detalle){
                        if($detalle->estacion_combustible_id==$row['id']){
                            $row['value']=$detalle->venta_electronica;
                            $row['odo']=$detalle->venta_odometro;
                        }
                    }
                    return $row;
                })
            ]);
        }
        dd($table);
        return view('excels.reportes.ventas.ventas',compact('combustibles','lecturas'));
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class=>function(AfterSheet $event){
                $general='A1:'.$event->sheet->getDelegate()->getCellCollection()->getCurrentCoordinate();

                $event->sheet->getDelegate()->getStyle($general)
                ->applyFromArray([
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
        ];
    }
    public function title(): string
    {
        $nombre=Estacion::find($this->id)->name;
        return $nombre;
    }
}
