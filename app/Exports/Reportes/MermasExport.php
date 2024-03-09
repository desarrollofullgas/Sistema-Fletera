<?php

namespace App\Exports\Reportes;

use App\Exports\Reportes\Sheets\MermasSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MermasExport implements WithMultipleSheets
{
    public $data;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data) {
        $this->data = $data;
    }
    public function sheets(): array
    {
        $arr=[];
        array_push($arr,new MermasSheet($this->data));
        return $arr;
    }
}
