<?php

namespace App\Http\Livewire\Lecturas;

use App\Models\Lectura;
use App\Models\LecturaDetalle;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LecturasEdit extends Component
{
    public $lecturaID;
    public $tlitros, $tpesos;
    public $detalles = [];

    public function mount($lecturaID)
    {
        $this->lecturaID = $lecturaID;

        $lectura = Lectura::findOrFail($lecturaID);
        $this->tlitros = $lectura->total_litros;
        $this->tpesos = $lectura->total_pesos;

        $this->detalles = $lectura->detalles()->get()->toArray();
    }

    public function updateLectura()
    {
        $this->validate([
            'tlitros' => ['required'],
            'tpesos' => ['required'],
            'detalles.*.veeder' => ['required'],
            'detalles.*.fisico' => ['required'],
            'detalles.*.vperiferico' => ['required'],
            'detalles.*.velectronica' => ['required'],
            'detalles.*.vodometro' => ['required'],
        ], [
            'tlitros.required' => 'El Campo es obligatorio',
            'tpesos.required' => 'El Campo es obligatorio',
            'detalles.*.veeder.required' => 'El Valor del VEEDER es Obligatorio',
            'detalles.*.fisico.required' => 'El Valor Físico es Obligatorio',
            'detalles.*.vperiferico.required' => 'El Campo es obligatorio',
            'detalles.*.velectronica.required' => 'El Campo es obligatorio',
            'detalles.*.vodometro.required' => 'El Campo es obligatorio',
        ]);

        try {
            $lectura = Lectura::findOrFail($this->lecturaId);
            $lectura->update([
                'total_litros' => $this->tlitros,
                'total_pesos' => $this->tpesos,
            ]);

            foreach ($this->detalles as $detalle) {
                $lecturaDetalle = LecturaDetalle::findOrFail($detalle['id']);
                $lecturaDetalle->update([
                    'veeder' => $detalle['veeder'],
                    'fisico' => $detalle['fisico'],
                    'venta_periferico' => $detalle['vperiferico'],
                    'venta_electronica' => $detalle['velectronica'],
                    'venta_odometro' => $detalle['vodometro'],
                ]);
            }

            session()->flash('flash.banner', 'Se ha actualizado correctamente la Lectura.');
            session()->flash('flash.bannerStyle', 'success');
            return redirect()->route('lecturas.index');
        } catch (\Exception $error) {
            Log::error('Error updating Lectura: ' . $error->getMessage());
            session()->flash('flash.banner', 'Ha ocurrido un error. Póngase en contacto con un administrador y proporcione el siguiente código: ' . $error->getMessage());
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->route('lecturas.index');
        }
    }

    public function render()
    {
        return view('livewire.lecturas.lecturas-edit');
    }
}
