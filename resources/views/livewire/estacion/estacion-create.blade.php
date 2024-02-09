<div class="col-md-4 col-sm-6 col-6 d-flex justify-content-end justify-content-md-end justify-content-sm-end">

    <div class="">
        <x-button class="float-right" wire:click="showModalFormEstacion">
            <i class="fa-solid fa-plus"></i>
            {{ __('Nueva Estación') }}
        </x-button>
    </div>

    <x-dialog-modal wire:model="newgEstacion" id="modalEstacion" class="flex items-center">
        <x-slot name="title">
            <div class="bg-dark-eval-1 dark:bg-gray-600 p-2 rounded-md text-white text-center">
                {{ __('Crear Estación') }}
            </div>
        </x-slot>

        <x-slot name="content">
            {{-- Paso #1 --}}
            <div wire:key="step1" class="{{ $currentStep == 1 ? 'block' : 'hidden' }}">
                <div class="flex items-center justify-center">
                    <span
                        class="bg-green-100 text-green-800 text-xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ __('Datos Generales') }}</span>
                </div>
                <div class=" px-4 pt-3 pb-4 flex gap-2">
                    <div class="md:w-1/2 px-3 md:mb-2">
                        <x-label value="{{ __('Nombre') }}" />
                        <x-input wire:model.defer="name"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('name') ? 'is-invalid' : '' }}"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error for="name"></x-input-error>
                    </div>
                    <div class="md:w-1/2 px-3">
                        <x-label  value="{{ __('Número') }}" />
                        <x-input wire:model="numero"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('numero') ? 'is-invalid' : '' }}"
                            type="text" name="numero" :value="old('numero')" required autofocus autocomplete="numero" />
                        <x-input-error for="numero"></x-input-error>
                    </div>
                </div>
                <div class=" px-4 pt-3 pb-4  flex gap-2">
                    <div class="md:w-1/2 px-3  md:mb-2">
                        <x-label value="{{ __('Razón Social') }}" />
                        <x-input wire:model.defer="razon"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('razon') ? 'is-invalid' : '' }}"
                            type="text" name="razon" :value="old('razon')" autocomplete="razon" />
                        <x-input-error for="razon"></x-input-error>
                    </div>
                    <div class="md:w-1/2 px-3  md:mb-2">
                        <x-label value="{{ __('RFC') }}" />
                        <x-input wire:model.defer="rfc"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('rfc') ? 'is-invalid' : '' }}"
                            type="text" name="rfc" :value="old('rfc')" autocomplete="rfc" />
                        <x-input-error for="rfc"></x-input-error>
                    </div>
                </div>

                <div class=" px-4 pt-3 pb-4 flex gap-2">
                    
                    <div class="md:w-1/2 px-3">
                        <x-label value="{{ __('SIIC') }}" />
                        <x-input wire:model.defer="siic"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('siic') ? 'is-invalid' : '' }}"
                            type="text" name="siic" :value="old('siic')" autocomplete="siic" />
                        <x-input-error for="siic"></x-input-error>
                    </div>
                </div>

                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <button
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-dark-eval-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                        wire:click="nextStep">
                        {{ __('Siguiente') }}
                    </button>
                </div>
            </div>
            {{-- Paso #2 --}}
            <div wire:key="step2" class="{{ $currentStep == 2 ? 'block' : 'hidden' }}">
                <div class="flex items-center justify-center">
                    <span
                        class="bg-green-100 text-green-800 text-xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ __('Ubicación:') }}</span>
                </div>

                <div class="flex gap-2 mb-3">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-label value="{{ __('Dirección') }}" />
                        <x-input wire:model.defer="direccion"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                            type="text" name="direccion" :value="old('direccion')" autocomplete="direccion" />
                        <x-input-error for="direccion"></x-input-error>
                    </div>
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0" wire:ignore>
                        <x-label value="{{ __('Zona') }}" />
                        <select id="zona" wire:model="zona"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('zona') ? 'is-invalid' : '' }}"
                            name="zona" required aria-required="true">
                            <option hidden value="" selected>Seleccionar Zona</option>
                            @foreach ($zonas as $zona)
                                @if ($zona->status == 'Activo')
                                    <option value="{{ $zona->id }}">
                                        {{ $zona->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <x-input-error for="zona"></x-input-error>
                    </div>
                </div>

                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                    <button
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-dark-eval-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                        wire:click="previousStep">
                        {{ __('Anterior') }}
                    </button>
                    <button
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-dark-eval-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                        wire:click="nextStep2">
                        {{ __('Siguiente') }}
                    </button>
                </div>
            </div>
            {{-- Paso #3 --}}
            <div wire:key="step3" class="{{ $currentStep == 3 ? 'block' : 'hidden' }}">
                <div class="flex items-center justify-center">
                    <span
                        class="bg-green-100 text-green-800 text-xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ __('Personal a Cargo:') }}</span>
                </div>
                <div class="flex gap-2 mb-3 pt-3">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-label value="{{ __('Supervisor') }}" />
                        <select id="supervisor" wire:model.defer="supervisor"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('supervisor') ? 'is-invalid' : '' }}"
                            name="supervisor" required aria-required="true">
                            @if ($this->isSuper)
                                <option hidden value="" selected>Seleccionar
                                    Supervisor</option>
                                @foreach ($this->isSuper as $superviso)
                                    <option value="{{ $superviso->id }}">
                                        {{ $superviso->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error for="supervisor"></x-input-error>
                    </div>
                    <div class="md:w-1/2 px-3">
                        <x-label  value="{{ __('Gerente') }}" />
                        <select id="gerente" wire:model.defer="gerente"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                                dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 {{ $errors->has('gerente') ? 'is-invalid' : '' }}"
                            name="gerente" required aria-required="true">
                            @if ($this->isGeren == null)
                                <option hidden value="" selected>Seleccionar Gerente
                                </option>
                            @else
                                <option hidden value="" selected>Seleccionar Gerente
                                </option>
                                @foreach ($this->isGeren as $gerent)
                                    @if ($gerent->estacion == null)
                                        <option value="{{ $gerent->id }}">
                                            {{ $gerent->name }}</option>
                                    @else
                                        <option hidden value="" selected>Seleccionar
                                            Gerente</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        <x-input-error for="gerente"></x-input-error>
                    </div>
                </div>
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <button
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-dark-eval-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                        wire:click="previousStep">
                        {{ __('Anterior') }}
                    </button>
                    <x-danger-button class="mr-2" wire:click="addEstacion" wire:loading.attr="disabled">
                        <div role="status" wire:loading wire:target="addEstacion">
                            <svg aria-hidden="true"
                                class="inline w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-white"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                        Aceptar
                    </x-danger-button>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer" class="d-none">
            <x-secondary-button wire:click="$toggle('newgEstacion')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
