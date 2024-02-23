<x-modal-create button_tittle="Datos del Provedor" tipo="show">
    <x-slot name="button_tittle">
        <x-icons.eye/>
    </x-slot>
    <x-slot name="content">
        <div class="overflow-hidden max-h-96 overflow-y-auto">
            <fieldset class="border dark:border-gray-500 p-2">
                <legend>Detalles del Proveedor</legend>
                <div>
                    <span><strong>Nombre Proveedor: </strong>{{$proveedor->name==null?'Por Definir':$proveedor->name}}</span>
                </div>
                <div class="mt-2 flex flex-wrap gap-3">
                    <span><strong>Razón Social: </strong>{{$proveedor->razon_social==null?'Por Definir':$proveedor->razon_social}}</span>
                    <span><strong>Dirección: </strong>{{$proveedor->direccion==null?'Por Definir':$proveedor->direccion}}</span>
                    <span><strong>RFC: </strong>{{$proveedor->rfc==null?'Por Definir':$proveedor->rfc}}</span>
                    <span><strong>Búsqueda: </strong>{{$proveedor->busqueda}}</span>
                </div>
            </fieldset>
        </div>
    </x-slot>
    <x-slot name="btn_action">
        <x-secondary-button @click="modelOpen = false" wire:loading.attr="disabled">
            Cerrar
        </x-secondary-button>
    </x-slot>
</x-modal-create>
