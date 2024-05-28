<x-app-layout>
    @section('title', 'Recepción de pipa')
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <x-card-greet-header>
                {{ __('RECEPCIÓN DE PIPA') }}
            </x-card-greet-header>
        </div>
    </x-slot>
    <div class="p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <fieldset class="border dark:border-gray-500 p-2 rounded-md">
            <legend class="text-xl px-2 bg-dark-eval-0 text-gray-200 rounded-md">Informacion de la pipa a recibir</legend>
            <div class="flex flex-col gap-4">
                <div class="flex flex-wrap gap-4 justify-evenly">
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
                        <span><strong>Cantidad: </strong>{{number_format($viaje->contenido)}} lts</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-4 justify-evenly">
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
                </div>
            </div>
        </fieldset>
    </div>
    <br>
    @livewire('recepcion.new-recepcion',['viajeID'=>$viaje->id])
</x-app-layout>