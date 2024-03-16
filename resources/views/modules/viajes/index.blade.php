<x-app-layout>
    @section('title', 'Control de viajes')
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <x-card-greet-header>
                {{ __('LISTADO DE VIAJES') }}
            </x-card-greet-header>
            <div class=" flex justify-center space-x-2">
                <x-menu-options>
                    <x-slot name="button">
                        <x-button variant="danger">
                            <x-icons.file-download/>
                        </x-button>
                    </x-slot>
                    <x-slot name="options">
                        @livewire('recepcion.gen-reporte-merma')
                        @livewire('viajes.gen-reporte-viajes')
                        @livewire('lecturas.gen-reporte-ventas')
                    </x-slot>
                </x-menu-options>
                @livewire('viajes.new-viaje')
            </div>
        </div>
    </x-slot>
    <div class="p-6 flex flex-col gap-4 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="{{route('viajes.search')}}" class="flex flex-wrap items-center gap-2">
            @if (in_array(Auth::user()->permiso_id,[1,2,4]))
                <x-input id="search" name="search" type="text" placeholder="Buscar No. viaje o estación..."/>
            @else
                <x-input id="search" name="search" type="text" placeholder="Buscar No. viaje ..."/>
            @endif
            <div class="flex flex-wrap gap-1 items-center">
                <x-input id="start" name="start" type="date"/>
                <span>al</span>
                <x-input id="end" name="end" type="date"/>
            </div>
            <button class="p-2 rounded-md bg-black dark:bg-slate-700 text-gray-200"><x-icons.search/></button>
        </form>
        @if ($viajes->count()>0)
            <x-table>
                <x-slot name="head">
                    <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">NUM. VIAJE</span></x-heading>
                    <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">DESTINO</span> </x-heading>
                    <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">UNIDAD</span></x-heading>
                    <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">OPERADOR</span></x-heading>
                    <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">COMBUSTIBLE</span></x-heading>
                    <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">PROVEEDOR</span></x-heading>
                    <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">ESTADO</span></x-heading>
                    <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">CREADO</span></x-heading>
                    <x-heading class="max-lg:hidden lg:table-cell"></x-heading>
                </x-slot>
                <x-slot name="body">
                    @foreach ($viajes as $viaje)
                        <x-row class="lg:table-row flex flex-col">
                            <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                                <div class="w-full flex items-strech gap-2">
                                    <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                        <span>id</span>
                                    </div>
                                    <p class="max-lg:my-2 break-all">
                                        {{$viaje->id}}
                                    </p>
                                </div>
                            </x-cell>
                            <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                                <div class="w-full flex items-strech gap-2">
                                    <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                        <span>DESTINO</span>
                                    </div>
                                    <p class="max-lg:my-2 break-all">
                                        {{$viaje->estacion->name}}
                                    </p>
                                </div>
                            </x-cell>
                            <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                                <div class="w-full flex items-strech gap-2">
                                    <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                        <span>UNIDAD</span>
                                    </div>
                                    <p class="max-lg:my-2 break-all">
                                        {{$viaje->unidad->tractor}}
                                    </p>
                                </div>
                            </x-cell>
                            <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                                <div class="w-full flex items-strech gap-2">
                                    <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                        <span>OPERADOR</span>
                                    </div>
                                    <p class="max-lg:my-2 break-all">
                                        {{$viaje->operador->name}}
                                    </p>
                                </div>
                            </x-cell>
                            <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                                <div class="w-full flex items-stretch gap-2">
                                    <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                        <span>COMBUSTIBLE</span>
                                    </div>
                                    @if ($viaje->combustible->tipo=='MAGNA')
                                        <span class="max-lg:my-2 px-2 py-1 bg-green-700 text-green-200 rounded-full">
                                            {{$viaje->combustible->tipo}}
                                        </span>
                                    @elseif($viaje->combustible->tipo=='PREMIUM')
                                        <span class="max-lg:my-2 px-2 py-1 bg-red-700 text-red-200 rounded-full">
                                            {{$viaje->combustible->tipo}}
                                        </span>
                                    @else
                                        <span class="max-lg:my-2 px-2 py-1 bg-black text-gray-200 rounded-full">
                                            {{$viaje->combustible->tipo}}
                                        </span>
                                    @endif
                                </div>
                            </x-cell>
                            <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                                <div class="w-full flex items-strech gap-2 max-w-xs">
                                    <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 min-w-[6rem] text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                        <span>PRVEEDOR</span>
                                    </div>
                                    <p class="max-lg:my-2 break-all">
                                        {{$viaje->proveedor->name}}
                                    </p>
                                </div>
                            </x-cell>
                            <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                                <div class="w-full flex items-strech gap-2">
                                    <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                        <span>ESTADO</span>
                                    </div>
                                    @if ($viaje->status=='En tránsito')
                                        <div class="max-lg:my-2 flex justify-center items-center gap-2 px-2 py-1 rounded-full bg-green-300 text-green-800">
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
                            </x-cell>
                            <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                                <div class="w-full flex items-center gap-2">
                                    <span class="lg:hidden bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                        CREADO
                                    </span>
                                    {{$viaje->created_at->locale('es')->isoFormat('D  MMMM  YYYY')}}
                                </div>
                            </x-cell>
                            <x-cell class="max-lg:p-0 flex justify-center items-stretch">
                                <div class="flex justify-center items-center rounded-b-md max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900 max-lg:w-full max-lg:mb-4">
                                    <div class="relative w-fit" x-data="{show:false}">
                                        <button class="text-gray-400 hover:text-indigo-500 p-2" @click="show=!show">
                                            <x-icons.dots-vertical class="max-lg:rotate-90"/>
                                        </button>
                                        <div class="px-2 w-max flex flex-col gap-1 absolute max-lg:bottom-full lg:top-0 lg:right-full rounded-md shadow-md dark:shadow-gray-700 bg-white dark:bg-dark-eval-3" x-cloack x-show="show" x-collapse @click.outside="show=false">
                                            @livewire('viajes.show-viaje',['viajeID' =>$viaje->id])
                                            @livewire('viajes.edit-viaje',['viajeID' =>$viaje->id])
                                            @livewire('viajes.delete-viaje',['viajeID' =>$viaje->id])
                                            @if ($viaje->status=='Descargando' && $viaje->recepcion==null)
                                                <a href="{{route('recepcion',$viaje->id)}}" target="_self" class="text-gray-400 hover:text-indigo-500 p-1 flex gap-2 items-center">
                                                    <x-icons.descarga-fuel/>
                                                    <span>Recepción de pipa</span>
                                                </a>
                                            @endif
                                            @if ($viaje->recepcion)
                                                <a href="{{route('recepcion.edit',$viaje->id)}}" class="text-gray-400 hover:text-indigo-500 p-1 flex gap-2 items-center">
                                                    <x-icons.file-pencil/>
                                                    <span>Editar recepción</span>
                                                </a>
                                            @endif
                                            {{-- @if ($viaje->status=='En tránsito')
                                                @livewire('viajes.change-status',['viajeID' =>$viaje->id])
                                            @endif --}}
                                           {{--  @livewire('viajes.doc-cataporte',['viajeID' =>$viaje->id]) --}}
                                            <a href="{{route('ct.archivo',$viaje->id)}}" target="_blank" class="text-gray-400 hover:text-indigo-500 p-1 flex gap-2 items-center">
                                                <x-icons.print/>
                                                <span>Carta porte</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </x-cell>
                        </x-row>
                    @endforeach
                </x-slot>
            </x-table>
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