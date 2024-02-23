<?php

namespace App\Exports;

use App\Models\Proveedor;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ProveedorExport implements FromQuery
{
    use Exportable;

    protected $proveedores;

    public function __construct($proveedores)
    {
        $this->proveedores=$proveedores;
    }

   public function query()
   {
    return Proveedor::query()->whereKey($this->proveedores);
   }
}
