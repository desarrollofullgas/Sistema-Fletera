<x-modal-create button_tittle="Registrar viaje" tittle="Nuevo registro de viaje">
    <x-slot name="content">
        <fieldset class="border dark:border-gray-500 p-2">
            <legend>Datos del viaje</legend>
            {{-- <div class="flex flex-wrap justify-evenly gap-2">
                <div class="w-full">
                    <x-label value="{{ __('Línea de transporte') }}" for="linea" class="before:content-['*'] before:text-red-500"/>
                    <select name="linea" id="linea" wire:model.defer="linea" class="w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                        <option hidden value="" selected>Línea de transporte</option>
                        @foreach ($lineas as $linea)
                            <option value="{{$linea->id}}">{{$linea->name}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="capacidad"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Número de unidad') }}" for="tractor" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="tractor" type="text" name="tractor"
                        id="tractor" required autofocus autocomplete="tractor" class="max-sm:w-full"/>
                    <x-input-error for="tractor"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Placa') }}" for="placa" />
                    <x-input wire:model.defer="placa" type="text" name="placa"
                        id="placa" required autofocus autocomplete="placa" class="max-sm:w-full"/>
                    <x-input-error for="placa"></x-input-error>
                    </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Marca') }}" for="marca" />
                    <x-input wire:model.defer="marca" type="text" name="marca"
                        id="marca" required autofocus autocomplete="marca" class="max-sm:w-full"/>
                    <x-input-error for="marca"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Modelo') }}" for="modelo" />
                    <x-input wire:model.defer="modelo" type="text" name="modelo"
                        id="modelo" required autofocus autocomplete="modelo" class="max-sm:w-full"/>
                    <x-input-error for="modelo"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Serie') }}" for="serie" />
                    <x-input wire:model.defer="serie" type="text" name="serie"
                        id="serie" required autofocus autocomplete="serie" class="max-sm:w-full"/>
                    <x-input-error for="serie"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Capacidad general') }}" for="capacidad" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="capacidad" type="number" name="capacidad"
                        id="capacidad" required autofocus autocomplete="capacidad" class="max-sm:w-full"/>
                    <x-input-error for="capacidad"></x-input-error>
                </div>
            </div> --}}
        </fieldset>
    </x-slot>
    <x-slot name="btn_action">
        <x-danger-button class="mr-2" wire:click='addViaje()' wire:loading.attr="disabled">
            <div role="status" wire:loading wire:target="addViaje">
                <x-icons.spin/>
                <span class="sr-only">Registrando...</span>
            </div>
            Aceptar
        </x-danger-button>
        <x-secondary-button @click="modelOpen = false" wire:loading.attr="disabled">
            Cancelar
        </x-secondary-button>
    </x-slot>
</x-modal-create>