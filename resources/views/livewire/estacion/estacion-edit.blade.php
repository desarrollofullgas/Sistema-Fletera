<div class="" id="">

    <button wire:click="confirmEstacionEdit({{ $estacion_id }})" wire:loading.attr="disabled" class="tooltip"
        data-target="EditEstacion{{ $estacion_id }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6 text-gray-400 hover:text-indigo-500">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
        </svg>
        <span class="tooltiptext">Editar</span>
    </button>

    <x-dialog-modal wire:model="EditEstacion" id="EditEstacion{{ $estacion_id }}" class="flex items-center">
        <x-slot name="title">
            <div class="bg-dark-eval-1 dark:bg-gray-600 p-2 rounded-md text-white text-center">
                {{ __('Editar Estación') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="shadow-md rounded px-4 flex flex-col max-h-[320px] overflow-y-auto">
                <div class="-mx-3 md:flex mb-2">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-label  value="{{ __('Nombre de la Estación') }}" />
                        <x-input wire:model="name" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error for="name"></x-input-error>
                    </div>
                    <div class="md:w-1/2 px-3">
                        <x-label  value="{{ __('Zona') }}" />
                        <select id="zona" wire:model="zona"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('zona') ? 'is-invalid' : '' }}"
                            name="zona" required aria-required="true">
                            <option value="">Seleccionar Zona</option>
                            @foreach ($zonas as $zonal)
                                <option value="{{ $zonal->id }}"
                                    @if ($zona == $zonal->id) {{ 'selected' }} @endif>
                                    {{ $zonal->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="zona"></x-input-error>
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-2">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-label  value="{{ __('Supervisor') }}" />
                        <select id="supervisor" wire:model.defer="supervisor"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('supervisor') ? 'is-invalid' : '' }}"
                            name="supervisor" required aria-required="true">
                            @if ($this->isSuper == null)
                                <option  value="" hidden >Seleccionar
                                    Supervisor</option>
                            @else
                                <option hidden value="" >Seleccionar
                                    Supervisor</option>
                                @foreach ($this->isSuper as $supervisorl)
                                    <option value="{{ $supervisorl->id }}"
                                        @if ($supervisor == $supervisorl->id) {{ 'selected' }} @endif>
                                        {{ $supervisorl->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error for="supervisor"></x-input-error>
                    </div>
                    <div class="md:w-1/2 px-3">
                        <x-label  value="{{ __('Gerente') }}" />
                        <select id="gerente" wire:model.defer="gerente"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('gerente') ? 'is-invalid' : '' }}"
                            name="gerente" required aria-required="true">
                            @if ($this->isGeren == null)
                                <option hidden value="" selected>Seleccionar Gerente
                                </option>
                            @else
                                <option hidden value="" selected>Seleccionar Gerente
                                </option>
                                @foreach ($this->isGeren as $gerentel)
                                    <option value="{{ $gerentel->id }}"
                                        @if ($gerente == $gerentel->id) {{ 'selected' }} @endif>
                                        {{ $gerentel->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error for="gerente"></x-input-error>
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-2">
                    <div class="md:w-1/2 px-3">
                        <x-label  value="{{ __('Número') }}" />
                        <x-input wire:model="numero" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('numero') ? 'is-invalid' : '' }}" type="text"
                            name="numero" :value="old('numero')" required autofocus autocomplete="numero" />
                        <x-input-error for="numero"></x-input-error>
                    </div>
                    <div class="md:w-1/2 px-3">
                        <x-label  value="{{ __('Status') }}" />
                        <select id="status" wire:model="status"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('status') ? 'is-invalid' : '' }}"
                            name="status" required aria-required="true">
                            <option hidden value="">Seleccionar Status</option>
                            <option value="Activo" @if ($status == 'Activo') {{ 'selected' }} @endif>
                                Activo</option>
                            <option value="Inactivo" @if ($status == 'Inactivo') {{ 'selected' }} @endif>
                                Inactivo</option>
                        </select>
                        <x-input-error for="status"></x-input-error>
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-2">
                    <div class="md:w-1/2 px-3">
                        <x-label  value="{{ __('Propietario') }}" />
                        <x-input wire:model="propietario" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('propietario') ? 'is-invalid' : '' }}" type="text"
                            name="propietario" :value="old('propietario')" autocomplete="propietario" />
                        <x-input-error for="propietario"></x-input-error>
                    </div>
                    <div class="md:w-1/2 px-3">
                        <x-label  value="{{ __('Razón Social') }}" />
                        <textarea wire:model.defer="razon"
                        class=" w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 {{ $errors->has('razon') ? 'is-invalid' : '' }} "
                        name="razon" >
                                </textarea>
                        <x-input-error for="razon"></x-input-error>
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-2">
                    <div class="md:w-1/2 px-3">
                        <x-label  value="{{ __('RFC') }}" />
                        <x-input wire:model="rfc" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('rfc') ? 'is-invalid' : '' }}" type="text"
                            name="rfc" :value="old('rfc')" required autofocus autocomplete="rfc" />
                        <x-input-error for="rfc"></x-input-error>
                    </div>
                    <div class="md:w-1/2 px-3">
                        <x-label  value="{{ __('SIIC') }}" />
                        <x-input wire:model="siic" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('siic') ? 'is-invalid' : '' }}" type="text"
                            name="siic" :value="old('siic')" autocomplete="siic" />
                        <x-input-error for="siic"></x-input-error>
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-2">
                    <div class="md:w-1/2 px-3">
                        <x-label  value="{{ __('IVA') }}" />
                        <x-input wire:model="iva" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('iva') ? 'is-invalid' : '' }}" type="text"
                            name="iva" :value="old('iva')" required autofocus autocomplete="iva" />
                        <x-input-error for="iva"></x-input-error>
                    </div>
                    <div class="md:w-1/2 px-3">
                        <x-label value="{{ __('Permiso CRE') }}" />
                        <x-input wire:model="num_cre" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('num_cre') ? 'is-invalid' : '' }}" type="text"
                            name="num_cre" :value="old('num_cre')" autocomplete="num_cre" />
                        <x-input-error for="num_cre"></x-input-error>
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-2">
                    <div class="md:w-1/2 px-3">
                        <x-label value="{{ __('Dirección') }}" />
                        <textarea wire:model.defer="direccion"
                    class=" w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 {{ $errors->has('direccion') ? 'is-invalid' : '' }} "
                    name="direccion" >
                            </textarea>
                        <x-input-error for="direccion"></x-input-error>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer" class="d-none">
            <x-danger-button class="mr-2" wire:click="EditarEstacion({{ $estacion_id }})"
                wire:loading.attr="disabled">
                <div role="status" wire:loading wire:target="EditarEstacion">
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

            <x-secondary-button wire:click="$toggle('EditEstacion')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
