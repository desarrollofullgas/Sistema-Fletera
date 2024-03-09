<?php

namespace App\Exports\Reportes\Sheets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ViajesSheet implements FromView,ShouldAutoSize,WithTitle,WithEvents
{
    public $data;
    public function __construct($data) {
        $this->data = $data;
    }
    public function view(): View
    {
        $viajes=$this->data;
        return view('excels.reportes.viajes.viajes',compact('viajes'));
    }
    public function registerEvents(): array
    {
        return[
            AfterSheet::class=>function(AfterSheet $event){
                $cabecera='A1:H1';
                $totalRows = $event->sheet->getHighestRow();
                $general='A1:H'.$totalRows;
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
        return 'Viajes';
    }
}
