<?php

namespace App\Exports\Reportes\Sheets;

use App\Models\Combustible;
use App\Models\Estacion;
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
        $estacion=Estacion::find($this->id);
        $combustibles=Combustible::whereHas('info',function(Builder $info)use($estacion){
            $info->where('estacion_id',$estacion->id);
        })->get();
        $lecturas=Lectura::where('estacion_id',$estacion->id)->whereHas('detalles',function(Builder $detalle)use($combustibles){
            $detalle->whereIn('combustible_id',$combustibles->pluck('id'));
        })->whereBetween('created_at',$this->rango)->orderBy('id','DESC')->get();
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