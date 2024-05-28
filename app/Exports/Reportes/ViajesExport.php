<?php

namespace App\Exports\Reportes;

use App\Exports\Reportes\Sheets\ViajesSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ViajesExport implements WithMultipleSheets
{
    public $data;
    public function __construct($data) {
        $this->data = $data;
    }
    public function sheets(): array
    {
        $arr=[];
        array_push($arr,new ViajesSheet($this->data));
        return $arr;
    }
}
