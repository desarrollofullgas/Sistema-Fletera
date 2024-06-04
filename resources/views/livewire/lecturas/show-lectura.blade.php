<x-modal-create tittle="" tipo="show" class="w-full">
    <x-slot name="button_tittle">
        <div class="flex items-center gap-2">
            <x-icons.eye/>
            <span>Detalles</span>
        </div>
    </x-slot>
    <x-slot name="content">
        <fieldset class="border dark:border-gray-500 p-2 max-h-96 overflow-y-auto">
            <legend class="text-xl">Información de la lectura</legend>
            <div class="flex flex-wrap justify-evenly gap-4">
                <div class="max-sm:w-full flex gap-2 items-center">
                    <x-icons.calendar/>
                    <span><strong>Fecha de registro: </strong>{{$lectura->created_at}}</span>
                </div>
                <div class="max-sm:w-full flex gap-2 items-center">
                    <x-icons.gas-station/>
                    <span><strong>Estacion destino: </strong>{{$lectura->estacion->name}}</span>
                </div>
                @foreach ($lectura->detalles as $detalle)
                    <div class="w-full border-y py-2 ">
                        <div class="max-sm:w-full flex gap-2 items-center">
                            <x-icons.oil/>
                            <span><strong>Combustible: </strong>
                                @if ($detalle->combustible->combustible->tipo=='MAGNA')
                                    <span class="px-2 py-1 bg-green-700 text-green-200 rounded-full">
                                        {{$detalle->combustible->combustible->tipo . ' - (TANQUE ' . number_format($detalle->combustible->capacidad).' lts)'}}
                                    </span>
                                @elseif($detalle->combustible->combustible->tipo=='PREMIUM')
                                    <span class="px-2 py-1 bg-red-700 text-red-200 rounded-full">
                                        {{$detalle->combustible->combustible->tipo . ' - (TANQUE ' . number_format($detalle->combustible->capacidad).' lts)'}}
                                    </span>
                                @else
                                    <span class="px-2 py-1 bg-black text-gray-200 rounded-full">
                                        {{$detalle->combustible->combustible->tipo . ' - (TANQUE ' . number_format($detalle->combustible->capacidad).' lts)'}}
                                    </span>
                                @endif
                            </span>
                        </div>
                        <br>
                        <fieldset class=" border-t dark:border-gray-500">
                            <legend class="mx-2 px-2 text-lg">Veeder y físico</legend>
                            <div class="flex flex-wrap gap-4 justify-center">
                                <span><strong>Veeder Root:</strong> {{number_format($detalle->veeder,2)}}</span>
                                <span><strong>Físico:</strong> {{number_format($detalle->fisico,2)}}</span>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class=" border-t dark:border-gray-500">
                            <legend class="mx-2 px-2 text-lg">Ventas</legend>
                            <div class="flex flex-wrap gap-4 justify-center">
                                <span><strong>Venta de perifericos:</strong> {{number_format($lectura->venta_periferico,2)}}</span>
                                <span><strong>Venta electrónica:</strong> {{number_format($lectura->venta_electronica,2)}}</span>
                                <span><strong>Odómetro:</strong> {{number_format($lectura->venta_odometro,2)}}</span>
                            </div>
                        </fieldset>
                    </div>    
                @endforeach
            </div>
        </fieldset>
        <div class="flex flex-wrap gap-4 justify-center mt-3">
            <span><strong>Total en pesos:</strong> ${{number_format($lectura->total_pesos,2)}}</span>
            <span><strong>Total en litros:</strong> {{number_format($lectura->total_litros,2)}}lts.</span>
        </div>
    </x-slot>
    <x-slot name="btn_action">
        <x-secondary-button @click="modelOpen = false" wire:loading.attr="disabled">
            Cerrar
        </x-secondary-button>
    </x-slot>
</x-modal-create>
