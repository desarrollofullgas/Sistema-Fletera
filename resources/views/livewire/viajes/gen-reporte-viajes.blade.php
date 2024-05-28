<x-modal-create  button_tittle="Reporte de viajes" tittle="Reporte de viajes" tipo="">
    <x-slot name="content">
        <div class="flex flex-wrap justify-center gap-2">
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
