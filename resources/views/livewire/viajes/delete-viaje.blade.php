<x-modal-create tipo="edit">
    <x-slot name="button_tittle">
        <x-icons.trash/>
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-col gap-2 justify-center">
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-20 h-20 text-yellow-500 bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
            </div>
            <span class="text-center dark:text-white">¿Está seguro de eliminar el viaje #<i>"{{$viajeID}}"</i> ?</span>
        </div>
    </x-slot>
    <x-slot name="btn_action">
        <x-danger-button class="mr-2" wire:click="deleteViaje" wire:loading.attr="disabled">
            <div role="status" wire:loading wire:target="deleteViaje">
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