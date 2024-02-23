<x-modal-create tittle="Editar viaje #{{$viajeID}}" tipo="edit">
    <x-slot name="button_tittle">
        <x-icons.edit/>
    </x-slot>
    <x-slot name="content">
        <fieldset class="border dark:border-gray-500 p-2">
            <legend>Datos del viaje</legend>
            <div class="flex flex-wrap justify-evenly gap-2">
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Estado del viaje') }}" for="status" class="before:content-['*'] before:text-red-500"/>
                    <select name="status" id="status" wire:model="status" class="sm:w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white max-sm:w-full">
                        <option hidden value="" selected>Seleccionar estado</option>
                        <option value="En tránsito" selected>En tránsito</option>
                        <option value="Descargando" selected>Descargando</option>
                        <option value="Finalizado" selected>Finalizado</option>
                    </select>
                    <x-input-error for="estacion"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Estación') }}" for="estacion" class="before:content-['*'] before:text-red-500"/>
                    <select name="estacion" id="estacion" wire:model="estacion" class="sm:w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white max-sm:w-full">
                        <option hidden value="" selected>Seleccionar estación</option>
                        @foreach ($estaciones as $estacion)
                            <option value="{{$estacion->id}}">{{$estacion->name}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="estacion"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Combustible') }}" for="combustible" class="before:content-['*'] before:text-red-500"/>
                    <select name="combustible" id="combustible" wire:model="combustible" class="sm:w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                        <option hidden value="" selected>Seleccionar combustible</option>
                        @foreach ($combustibles as $combustible)
                            <option value="{{$combustible->id}}">{{$combustible->tipo}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="combustible"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Proveedor') }}" for="proveedor" class="before:content-['*'] before:text-red-500"/>
                    <select name="proveedor" id="proveedor" wire:model="proveedor" class="sm:w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                        <option hidden value="" selected>Seleccionar proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{$proveedor->id}}">{{$proveedor->name}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="proveedor"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Operador') }}" for="operador" class="before:content-['*'] before:text-red-500"/>
                    <select name="operador" id="operador" wire:model="operador" class="sm:w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                        <option hidden value="" selected>Seleccionar operador</option>
                        @foreach ($operadores as $operador)
                            <option value="{{$operador->id}}">{{$operador->name}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="operador"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Unidad de transporte')}}" for="unidad" class="before:content-['*'] before:text-red-500"/>
                    <select name="unidad" id="unidad" wire:model="unidad" class="sm:w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                        <option hidden value="" selected>Seleccionar unidad</option>
                        @foreach ($unidades as $unidad)
                            <option value="{{$unidad->id}}">{{$unidad->tractor}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="unidad"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Tonel de la unidad')}}" for="pipa" class="before:content-['*'] before:text-red-500"/>
                    <select name="pipa" id="pipa" wire:model="pipa" class="sm:w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                        <option hidden value="" selected>Seleccionar tonel</option>
                        @foreach ($pipas as $pipa)
                            <option value="{{$pipa->id}}">{{$pipa->toneles}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="unidad"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Capacidad de combustible (litros)') }}" for="contenido" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="contenido" type="number" name="contenido" min=0
                        id="contenido" required autofocus autocomplete="contenido" class="max-sm:w-full"/>
                    <x-input-error for="contenido"></x-input-error>
                </div>
            </div>
        </fieldset>
    </x-slot>
    <x-slot name="btn_action">
        <x-danger-button class="mr-2" wire:click='updateViaje()' wire:loading.attr="disabled">
            <div role="status" wire:loading wire:target="updateViaje">
                <x-icons.spin/>
                <span class="sr-only">Registrando...</span>
            </div>
            Actualizar
        </x-danger-button>
        <x-secondary-button @click="modelOpen = false" wire:loading.attr="disabled">
            Cancelar
        </x-secondary-button>
    </x-slot>
</x-modal-create>