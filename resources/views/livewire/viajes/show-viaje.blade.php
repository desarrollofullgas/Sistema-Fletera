<x-modal-create tittle="" tipo="show" class="w-full">
    <x-slot name="button_tittle">
        <div class="flex items-center gap-2">
            <x-icons.eye/>
            <span>Detalles del viaje</span>
        </div>
    </x-slot>
    <x-slot name="content">
        <fieldset class="border dark:border-gray-500 p-2">
            <legend class="text-xl">Datos del viaje # {{$viajeID}}</legend>
            <div class="flex flex-wrap justify-evenly gap-4">
                <div class="max-sm:w-full flex gap-2 items-center">
                    <x-icons.calendar/>
                    <span><strong>Fecha de registro: </strong>{{$viaje->created_at}}</span>
                </div>
                <div class="max-sm:w-full flex gap-2 items-center">
                    <x-icons.gas-station/>
                    <span><strong>Estacion destino: </strong>{{$viaje->estacion->name}}</span>
                </div>
                <div class="max-sm:w-full flex gap-2 items-center">
                    <x-icons.oil/>
                    <span><strong>Combustible: </strong>
                        @if ($viaje->combustible->tipo=='MAGNA')
                            <span class="px-2 py-1 bg-green-700 text-green-200 rounded-full">
                                {{$viaje->combustible->tipo}}
                            </span>
                        @elseif($viaje->combustible->tipo=='PREMIUM')
                            <span class="px-2 py-1 bg-red-700 text-red-200 rounded-full">
                                {{$viaje->combustible->tipo}}
                            </span>
                        @else
                            <span class="px-2 py-1 bg-black text-gray-200 rounded-full">
                                {{$viaje->combustible->tipo}}
                            </span>
                        @endif
                    </span>
                </div>
                <div class="max-sm:w-full flex gap-2 items-center">
                    
                    <span><strong>Proveedor: </strong>{{$viaje->proveedor->name}}</span>
                </div>
                <div class="max-sm:w-full flex gap-2 items-center">
                    <x-icons.id-card/>
                    <span><strong>Operador: </strong>{{$viaje->operador->name}}</span>
                </div>
                <div class="max-sm:w-full flex gap-2 items-center">
                    <x-icons.truck/>
                    <span><strong>Unidad: </strong>{{$viaje->unidad->tractor}}</span>
                </div>
                <div class="max-sm:w-full flex gap-2 items-center">
                    <x-icons.fuel-tank/>
                    <span><strong>Tonel seleccionado: </strong>{{$viaje->tonel->toneles}}</span>
                </div>
                <div class="max-sm:w-full flex gap-2 items-center">
                    <span><strong>Cantidad: </strong>{{number_format($viaje->contenido)}} lts</span>
                </div>
            </div>
        </fieldset>
    </x-slot>
    <x-slot name="btn_action">
        <x-secondary-button @click="modelOpen = false" wire:loading.attr="disabled">
            Cerrar
        </x-secondary-button>
    </x-slot>
</x-modal-create>
