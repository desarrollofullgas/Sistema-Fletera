<x-modal-create button_tittle="Reporte de mermas" tittle="Reporte de merma" tipo="">
    <x-slot name="content">
        <div x-data="{ind:false}">
            <div class="flex justify-center gap-2">
                <div>
                    <input type="radio" id="general" name="tipo" value="general"  wire:model.defer='tipo' class="peer/gral hidden">
                    <label for="general" class="px-2 py-1 rounded-full cursor-pointer bg-gray-400 text-gray-200 dark:bg-dark-eval-0 peer-checked/gral:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-700" @click="ind=false">
                        General
                    </label>
                </div>
                <div>
                    <input type="radio" id="only" name="tipo" value="only"  wire:model.defer='tipo' class="peer/ind hidden">
                    <label for="only" class="px-2 py-1 rounded-full cursor-pointer bg-gray-400 text-gray-200 dark:bg-dark-eval-0 peer-checked/ind:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-700" @click="ind=true">
                        Individual
                    </label>
                </div>
            </div>
            <br>
            <div class="flex flex-wrap justify-center gap-2">
                <div class="max-sm:w-full" x-cloak x-show="ind">
                    <x-label value="{{ __('Estación') }}" for="estacion" class="before:content-['*'] before:text-red-500"/>
                    <select name="estacion" id="estacion" wire:model="estacion" class="sm:w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white max-sm:w-full">
                        <option hidden value="" selected>Seleccionar estación</option>
                        @foreach ($estaciones as $estacion)
                            <option value="{{$estacion->id}}">{{$estacion->name}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="estacion"></x-input-error>
                </div>
                <div>
                    <x-label value="{{ __('Fecha de inicio') }}" for="start" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="start" type="date" name="start"
                        id="start" required autofocus autocomplete="start" class="max-sm:w-full"/>
                    <x-input-error for="start"></x-input-error>
                </div>
                <div>
                    <x-label value="{{ __('Fecha final') }}" for="end" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="end" type="date" name="end"
                        id="end" required autofocus autocomplete="end" class="max-sm:w-full"/>
                    <x-input-error for="end"></x-input-error>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="btn_action">
        <x-danger-button class="mr-2" wire:click="genReporte" wire:loading.attr="disabled">
            <div role="status" wire:loading wire:target="genReporte">
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
