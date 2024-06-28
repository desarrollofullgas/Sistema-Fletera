<div>
    <div class="flex flex-wrap items-center gap-2 mb-3">
        <x-input id="search" name="search" type="text" placeholder="{{in_array(Auth::user()->permiso_id,[1,2,4])?'Buscar No. cartaporte o estación...':'Buscar No. cartaporte...'}}" wire:model="search"/>
        <div class="flex flex-wrap gap-1 items-center">
            <x-input id="start" name="start" type="date" wire:model="start"/>
            <span>al</span>
            <x-input id="end" name="end" type="date" wire:model="end"/>
        </div>
    </div>
@if ($this->recepciones->count()>0)
        <x-table>
            <x-slot name="head">
                <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">CARTAPORTE</span></x-heading>
                <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">REGISTRADO</span></x-heading>
                <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">DESTINO</span> </x-heading>
                <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">UNIDAD</span></x-heading>
                <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">PRODUCTO</span></x-heading>
                <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">OPERADOR</span></x-heading>
                <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">CANT. FACTURADA</span></x-heading>
                <x-heading class="max-lg:hidden lg:table-cell"><span class="text-gray-200">ESTADO</span></x-heading>
                <x-heading class="max-lg:hidden lg:table-cell"></x-heading>
            </x-slot>
            <x-slot name="body">
                @foreach ($this->recepciones as $recepcion)
                    <x-row class="lg:table-row flex flex-col" wire:key='rw{{$recepcion->id}}'>
                        <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                            <div class="w-full flex items-strech gap-2">
                                <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                    <span>CARTAPORTE</span>
                                </div>
                                <p class="max-lg:my-2 break-all">
                                    {{$recepcion->cataporte->id}}
                                </p>
                            </div>
                        </x-cell>
                        <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                            <div class="w-full flex items-strech gap-2">
                                <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                    <span>REGISTRADO</span>
                                </div>
                                <p class="max-lg:my-2 break-all">
                                    {{$recepcion->created_at->locale('es')->isoFormat('D  MMMM  YYYY')}}
                                </p>
                            </div>
                        </x-cell>
                        <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                            <div class="w-full flex items-strech gap-2">
                                <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                    <span>DESTINO</span>
                                </div>
                                <p class="max-lg:my-2 break-all">
                                    {{$recepcion->cataporte->estacion->name}}
                                </p>
                            </div>
                        </x-cell>
                        <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                            <div class="w-full flex items-strech gap-2">
                                <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                    <span>UNIDAD</span>
                                </div>
                                <p class="max-lg:my-2 break-all">
                                    {{$recepcion->cataporte->unidad->tractor}}
                                </p>
                            </div>
                        </x-cell>
                        <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                            <div class="w-full flex items-stretch gap-2">
                                <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                    <span>COMBUSTIBLE</span>
                                </div>
                                @if ($recepcion->cataporte->combustible->tipo=='MAGNA')
                                    <span class="max-lg:my-2 px-2 py-1 bg-green-700 text-green-200 rounded-full">
                                        {{$recepcion->cataporte->combustible->tipo}}
                                    </span>
                                @elseif($recepcion->cataporte->combustible->tipo=='PREMIUM')
                                    <span class="max-lg:my-2 px-2 py-1 bg-red-700 text-red-200 rounded-full">
                                        {{$recepcion->cataporte->combustible->tipo}}
                                    </span>
                                @else
                                    <span class="max-lg:my-2 px-2 py-1 bg-black text-gray-200 rounded-full">
                                        {{$recepcion->cataporte->combustible->tipo}}
                                    </span>
                                @endif
                            </div>
                        </x-cell>
                        <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                            <div class="w-full flex items-strech gap-2 max-w-xs">
                                <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 min-w-[6rem] text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                    <span>OPERADOR</span>
                                </div>
                                <p class="max-lg:my-2 break-all">
                                    {{$recepcion->cataporte->operador->name}}
                                </p>
                            </div>
                        </x-cell>
                        <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                            <div class="w-full flex items-strech gap-2">
                                <div class="lg:hidden flex items-center bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                    <span>CANT. FACTURADA</span>
                                </div>
                                <p class="max-lg:my-2 break-all">
                                    {{$recepcion->importe}}
                                </p>
                            </div>
                        </x-cell>
                        <x-cell class="max-lg:p-0 max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900">
                            <div class="w-full flex items-center gap-2">
                                <span class="lg:hidden bg-blue-200 py-2 px-1 w-24 text-xs font-bold uppercase dark:bg-blue-900 dark:text-blue-200">
                                    CREADO
                                </span>
                                {{$recepcion->created_at->locale('es')->isoFormat('D  MMMM  YYYY')}}
                            </div>
                        </x-cell>
                        <x-cell class="max-lg:p-0 flex justify-center items-stretch">
                            <div class="flex justify-center items-center rounded-b-md max-lg:border max-lg:border-blue-200 max-lg:dark:border-blue-900 max-lg:w-full max-lg:mb-4">
                                <div class="relative w-fit z-10" x-data="{show:false}">
                                    <button class="text-gray-400 hover:text-indigo-500 p-2" @click="show=!show">
                                        <x-icons.dots-vertical class="max-lg:rotate-90"/>
                                    </button>
                                    <div class="px-2 w-max flex flex-col gap-1 absolute max-lg:bottom-full lg:top-0 lg:right-full rounded-md shadow-md dark:shadow-gray-700 bg-white dark:bg-dark-eval-3" x-cloack x-show="show" x-collapse @click.outside="show=false">
                                        @if ($valid->pivot->ed==1)
                                            <a href="{{route('recepcion.edit',$recepcion->cataporte->id)}}" class="text-gray-400 hover:text-indigo-500 p-1 flex gap-2 items-center" wire:key='ed{{$recepcion->id}}'>
                                                <x-icons.file-pencil/>
                                                <span>Editar recepción</span>
                                            </a>
                                        @endif
                                        <a href="{{route('recepcion.doc',$recepcion->id)}}" target="_blank" class="text-gray-400 hover:text-indigo-500 p-1 flex gap-2 items-center" wire:key='doc{{$recepcion->id}}'>
                                            <x-icons.print/>
                                            <span>Ver documento</span>
                                        </a>
                                        @if ($valid->pivot->de==1)
                                            @livewire('recepcion.delete-recepcion',['recepcionID'=>$recepcion->id],key('del'.$recepcion->id))
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </x-cell>
                    </x-row>
                @endforeach
            </x-slot>
        </x-table>
        {{$this->recepciones->links()}}
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
