<?php

namespace App\Exports;

use App\Models\Operador;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class OperadorExport implements FromQuery
{
    use Exportable;

    protected $operadores;

    public function __construct($operadores)
    {
        $this->operadores=$operadores;
    }

   public function query()
   {
    return Operador::query()->whereKey($this->operadores);
   }
}