<?php

namespace App\Exports;

use App\Models\Unidad;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class UnidadesExport implements FromQuery
{
    use Exportable;

    protected $unidades;

    public function __construct($unidades)
    {
        $this->unidades=$unidades;
    }

   public function query()
   {
    return Unidad::query()->whereKey($this->unidades);
   }
}