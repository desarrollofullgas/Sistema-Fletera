<div>

    <button wire:click="confirmOpEdit({{ $ope_id }})" wire:loading.attr="disabled" class="tooltip"
        data-target="EditOp{{ $ope_id }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6 text-gray-400 hover:text-indigo-500">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
        </svg>
        <span class="tooltiptext">Editar</span>
    </button>

    <x-dialog-modal wire:model="EditOp" id="EditOp{{ $ope_id }}" class="flex items-center">
        <x-slot name="title">
            <div class="bg-dark-eval-1 dark:bg-gray-600 p-1 rounded-md text-white text-center">
                {{ __('Editar Operador') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-wrap">
                <div class="mb-3 mr-2 ">
                    <x-label value="{{ __('Nombre') }}" />

                    <x-input wire:model="name" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                        name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error for="name"></x-input-error>
                </div>
                <div class="mb-3 mr-2 col-6" wire:ignore>
                    <x-label value="{{ __('Status') }}" />
                    <x-input wire:model="status" class="{{ $errors->has('status') ? 'is-invalid' : '' }}" type="text"
                        name="status" :value="old('status')" required autofocus autocomplete="status" />
                    <x-input-error for="status"></x-input-error>
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="mb-3 mr-2 ">
                    <x-label value="{{ __('Nombre') }}" />

                    <x-input wire:model="name" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                        name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error for="name"></x-input-error>
                </div>
                <div class="mb-3 mr-2 col-6" wire:ignore>
                    <x-label value="{{ __('Status') }}" />
                    <x-input wire:model="status" class="{{ $errors->has('status') ? 'is-invalid' : '' }}" type="text"
                        name="status" :value="old('status')" required autofocus autocomplete="status" />
                    <x-input-error for="status"></x-input-error>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer" class="d-none">
            <x-danger-button class="mr-2" wire:click="EditarOperador({{ $ope_id }})" wire:loading.attr="disabled">
                Aceptar
            </x-danger-button>

            <x-secondary-button wire:click="$toggle('EditOp')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
