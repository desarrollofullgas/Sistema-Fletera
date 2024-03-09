<?php

namespace App\Exports\Reportes;

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
        return $arr;
    }
}
