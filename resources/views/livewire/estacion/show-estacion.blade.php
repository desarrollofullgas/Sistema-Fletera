
<x-modal-create button_tittle="Datos de la estacion" tipo="delete">
    <x-slot name="button_tittle">
        <x-icons.eye/>
    </x-slot>
    <x-slot name="content">
        <div class="overflow-hidden max-h-96 overflow-y-auto">
            <fieldset class="border dark:border-gray-500 p-2">
                <legend class="font-bold">Detalles de la Estación</legend>
                <div>
                    <span><strong>Estación: </strong>{{$estacion->name}}</span>
                    <span><strong>Numero Estación: </strong>{{$estacion->num_estacion==null?'POR DEFINIR':$estacion->num_estacion}}</span>
                </div>
                <div class="mt-2 flex flex-wrap gap-3">
                    <span><strong>Razón Social: </strong>{{$estacion->razon_social==null?'POR DEFINIR':$estacion->razon_social}}</span>
                    <span><strong>RFC: </strong>{{$estacion->rfc==null?'POR DEFINIR':$estacion->rfc}}</span>
                    <span><strong>SIIC: </strong>{{$estacion->siic==null?'POR DEFINIR':$estacion->siic}}</span>
                    <span><strong>IVA: </strong>{{$estacion->iva==null?'POR DEFINIR':$estacion->iva}}</span>
                    <span><strong>Permiso CRE: </strong>{{$estacion->num_cre==null?'POR DEFINIR':$estacion->num_cre}}</span>
                    <span><strong>Dirección: </strong>{{$estacion->direccion==null?'POR DEFINIR':$estacion->direccion}}</span>
                    <span><strong>Gerente: </strong>{{$this->gerente==null?'POR DEFINIR':$this->gerente}}</span>
                    <span><strong>Supervisor: </strong>{{$this->supervisor==null?'POR DEFINIR':$this->supervisor}}</span>
                    <span><strong>Propietario: </strong>{{$estacion->propietario==null?'POR DEFINIR':$estacion->propietario}}</span>
                    <span><strong>Zonas: </strong>{{$estacion->zona->name==null?'POR DEFINIR':$estacion->zona->name}}</span>
                </div>
            </fieldset>
            {{-- <fieldset class="border dark:border-gray-500 p-2 max-h-60 overflow-y-auto">
                <legend>Detalles de los toneles</legend>
                @foreach ($estacion->toneles as $key => $tonel)
                    <fieldset class="border-t dark:border-gray-500">
                        <legend class="mx-2 px-1">Tonel #{{$key+1}}</legend>
                        <div class="mt-2 flex flex-wrap gap-3 justify-evenly">
                            <span><strong>Tipo de tonel: </strong>{{$tonel->toneles}}</span>
                            <span><strong>Placa: </strong>{{$tonel->placa==null?'S/N':$tonel->placa}}</span>
                            <span><strong>Marca: </strong>{{$tonel->marca==null?'S/N':$tonel->marca}}</span>
                            <span><strong>Serie: </strong>{{$tonel->serie==null?'S/N':$tonel->serie}}</span>
                        </div>
                    </fieldset>
                @endforeach
            </fieldset> --}}
        </div>
    </x-slot>
    <x-slot name="btn_action">
        <x-secondary-button @click="modelOpen = false" wire:loading.attr="disabled">
            Cerrar
        </x-secondary-button>
    </x-slot>
</x-modal-create>

