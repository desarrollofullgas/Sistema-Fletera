<x-app-layout>
    @section('title', 'Control de viajes')
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <x-card-greet-header>
                {{ __('LISTADO DE VIAJES') }}
            </x-card-greet-header>
            <div class=" flex justify-center space-x-2">
                @livewire('viajes.new-viaje')
            </div>
        </div>
    </x-slot>
    <div class="p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @if ($viajes->count()>0)
            <table>
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell dark:bg-slate-700 dark:text-gray-300 dark:border-gray-700">
                            NUM. VIAJE
                        </th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell dark:bg-slate-700 dark:text-gray-300 dark:border-gray-700">
                            DESTINO
                        </th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell dark:bg-slate-700 dark:text-gray-300 dark:border-gray-700">
                            COMBUSTIBLE
                        </th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell dark:bg-slate-700 dark:text-gray-300 dark:border-gray-700">
                            OPERADOR
                        </th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell dark:bg-slate-700 dark:text-gray-300 dark:border-gray-700">
                            UNIDAD
                        </th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell dark:bg-slate-700 dark:text-gray-300 dark:border-gray-700">
                            PROVEEDOR
                        </th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell dark:bg-slate-700 dark:text-gray-300 dark:border-gray-700">
                            ESTADO
                        </th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell dark:bg-slate-700 dark:text-gray-300 dark:border-gray-700">
                            OPCIONES
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viajes as $viaje)
                        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 dark:bg-slate-800 dark:lg:hover:bg-slate-600">
                            <th  class="w-full font-medium text-sm lg:w-auto p-3 text-gray-800 text-center border border-b dark:text-gray-400  dark:border-gray-700">
                                <div class="w-full flex justify-center gap-2">
                                    <span class="lg:hidden bg-blue-200 p-1 text-xs font-bold uppercase dark:bg-blue-600 dark:text-white">
                                        viaje
                                    </span>
                                    {{$viaje->id}}
                                </div>
                            </th>
                            <th  class="w-full font-medium text-sm lg:w-auto p-3 text-gray-800 text-center border border-b dark:text-gray-400  dark:border-gray-700">
                                <div class="w-full flex justify-center gap-2">
                                    <span class="lg:hidden bg-blue-200 p-1 text-xs font-bold uppercase dark:bg-blue-600 dark:text-white">
                                        DESTINO
                                    </span>
                                    {{$viaje->estacion->name}}
                                </div>
                            </th>
                            <th  class="w-full font-medium text-sm lg:w-auto p-3 text-gray-800 text-center border border-b dark:text-gray-400  dark:border-gray-700">
                                <div class="w-full flex justify-center gap-2">
                                    <span class="lg:hidden bg-blue-200 p-1 text-xs font-bold uppercase dark:bg-blue-600 dark:text-white">
                                        COMBUSTIBLE
                                    </span>
                                    
                                    {{$viaje->combustible->tipo}}
                                </div>
                            </th>
                            <th  class="w-full font-medium text-sm lg:w-auto p-3 text-gray-800 text-center border border-b dark:text-gray-400  dark:border-gray-700">
                                <div class="w-full flex justify-center gap-2">
                                    <span class="lg:hidden bg-blue-200 p-1 text-xs font-bold uppercase dark:bg-blue-600 dark:text-white">
                                        OPERADOR
                                    </span>
                                    {{$viaje->operador->name}}
                                </div>
                            </th>
                            <th  class="w-full font-medium text-sm lg:w-auto p-3 text-gray-800 text-center border border-b dark:text-gray-400  dark:border-gray-700">
                                <div class="w-full flex justify-center gap-2">
                                    <span class="lg:hidden bg-blue-200 p-1 text-xs font-bold uppercase dark:bg-blue-600 dark:text-white">
                                        UNIDAD
                                    </span>
                                    @if ($viaje->combustible->tipo=='Magna')
                                        <span class="px-2 py-1 bg-green-700 text-green-200 rounded-full">
                                            {{$viaje->combustible->tipo}}
                                        </span>
                                    @elseif($viaje->combustible->tipo=='Premium')
                                        <span class="px-2 py-1 bg-red-700 text-red-200 rounded-full">
                                            {{$viaje->combustible->tipo}}
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-black text-gray-200 rounded-full">
                                            {{$viaje->combustible->tipo}}
                                        </span>
                                    @endif
                                </div>
                            </th>
                            <th  class="w-full font-medium text-sm lg:w-auto p-3 text-gray-800 text-center border border-b dark:text-gray-400  dark:border-gray-700">
                                <div class="w-full flex justify-center gap-2">
                                    <span class="lg:hidden bg-blue-200 p-1 text-xs font-bold uppercase dark:bg-blue-600 dark:text-white">
                                        PROVEEDOR
                                    </span>
                                    {{$viaje->proveedor->name}}
                                </div>
                            </th>
                            <th  class="w-full font-medium text-sm lg:w-auto p-3 text-gray-800 text-center border border-b dark:text-gray-400  dark:border-gray-700">
                                <div class="w-full flex justify-center gap-2">
                                    <span class="lg:hidden bg-blue-200 p-1 text-xs font-bold uppercase dark:bg-blue-600 dark:text-white">
                                        ESTADO
                                    </span>
                                    @if ($viaje->status=='En tránsito')
                                        <div class="flex justify-center items-center gap-2 px-2 py-1 rounded-full bg-green-300 text-green-800">
                                            <span>
                                                <x-icons.truck/>
                                            </span>
                                            <span>
                                                {{$viaje->status}}
                                            </span>
                                        </div>
                                        @elseif($viaje->status=='Descargando')
                                        <div class="flex justify-center items-center gap-2 px-2 py-1 rounded-full bg-amber-300 text-amber-800">
                                            <span>
                                                <x-icons.pipa-descarga/>
                                            </span>
                                            <span>
                                                {{$viaje->status}}
                                            </span>
                                        </div>
                                    @else
                                        <div class="flex justify-center items-center gap-2 px-2 py-1 rounded-full bg-gray-300 text-gray-800">
                                            <span>
                                                <x-icons.circle-check/>
                                            </span>
                                            <span>
                                                {{$viaje->status}}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </th>
                            <th  class="w-full font-medium text-sm lg:w-auto p-3 text-gray-800 text-center border border-b dark:text-gray-400  dark:border-gray-700">
                                <div class="w-full flex justify-center gap-2">
                                    @livewire('viajes.show-viaje',['viajeID' =>$viaje->id])
                                    @livewire('viajes.edit-viaje',['viajeID' =>$viaje->id])
                                    @livewire('viajes.delete-viaje',['viajeID' =>$viaje->id])
                                    @if ($viaje->status!='Finalizado')
                                        @livewire('viajes.change-status',['viajeID' =>$viaje->id])
                                    @endif
                                    @livewire('viajes.doc-cataporte',['viajeID' =>$viaje->id])
                                    <a href="{{route('ct.archivo',$viaje->id)}}" target="_blank">
                                        <x-icons.print/>
                                    </a>
                                    {{-- @livewire('viajes.delete-unidad', ['unidadID' => $unidad->id])
                                    @livewire('viajes.show-unidad',['unidadID' => $unidad->id])
                                    <a href="{{route('unidad.edit',$unidad->id)}}" class="text-gray-400 hover:text-indigo-500"><x-icons.edit/></a> --}}
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$viajes->links()}}
        @else
            <div class="flex flex-col justify-center items-center gap-3 py-6 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="max-w-[200px] bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
                <span class="text-2xl">No hay datos registrados</span>
            </div>
        @endif
    </div>

</x-app-layout>