<x-modal-create button_tittle="Datos de la unidad" tipo="show">
    <x-slot name="button_tittle">
        <x-icons.eye/>
    </x-slot>
    <x-slot name="content">
        <div class="overflow-hidden max-h-96 overflow-y-auto">
            <fieldset class="border dark:border-gray-500 p-2">
                <legend>Detalles de la unidad</legend>
                <div>
                    <span><strong>Número de unidad: </strong>{{$unidad->tractor}}</span>
                </div>
                <div class="mt-2 flex flex-wrap gap-3">
                    <span><strong>Placa: </strong>{{$unidad->placa==null?'S/N':$unidad->placa}}</span>
                    <span><strong>Marca: </strong>{{$unidad->marca==null?'S/N':$unidad->marca}}</span>
                    <span><strong>Serie: </strong>{{$unidad->serie==null?'S/N':$unidad->serie}}</span>
                    <span><strong>Capacidad total: </strong>{{$unidad->capacidad}} lts</span>
                </div>
            </fieldset>
            <fieldset class="border dark:border-gray-500 p-2 max-h-60 overflow-y-auto">
                <legend>Detalles de los toneles</legend>
                @foreach ($unidad->toneles as $key => $tonel)
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
            </fieldset>
        </div>
    </x-slot>
    <x-slot name="btn_action">
        <x-secondary-button @click="modelOpen = false" wire:loading.attr="disabled">
            Cerrar
        </x-secondary-button>
    </x-slot>
</x-modal-create>