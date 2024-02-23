<?php

namespace App\Exports;

use App\Models\Linea;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class LineasExport implements FromQuery
{
    use Exportable;

    protected $lineas;

    public function __construct($lineas)
    {
        $this->lineas=$lineas;
    }

   public function query()
   {
    return Linea::query()->whereKey($this->lineas);
   }
}