<x-modal-create button_tittle="Nueva Estación" tittle="Nueva Estación de Servicio">
    <x-slot name="content">
        <fieldset class="border dark:border-gray-500 p-2 overflow-hidden max-h-60 overflow-y-auto">
            <legend class="font-bold before:content-['*'] before:text-red-500">Datos de Estación</legend>
            <div class="flex flex-wrap justify-evenly gap-2">
                <div class="w-full">
                    <x-label value="{{ __('Nombre') }}" for="name" />
                    <x-input wire:model.defer="name"
                        class="w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error for="name"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Número de estación') }}"  />
                    <x-input wire:model.defer="numero" type="number" name="numero" id="numero" required autofocus
                        autocomplete="numero" class="max-sm:w-full" />
                    <x-input-error for="numero"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Razón Social') }}" for="razon" />
                    <x-input wire:model.defer="razon" type="text" name="razon" id="razon" required autofocus
                        autocomplete="razon" class="max-sm:w-full" />
                    <x-input-error for="razon"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('RFC') }}" for="rfc" />
                    <x-input wire:model.defer="rfc" type="text" name="rfc" id="rfc" required autofocus
                        autocomplete="rfc" class="max-sm:w-full" />
                    <x-input-error for="rfc"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('SIIC') }}" for="siic" />
                    <x-input wire:model.defer="siic" type="text" name="siic" id="siic" required autofocus
                        autocomplete="siic" class="max-sm:w-full" />
                    <x-input-error for="siic"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('IVA') }}" for="iva" />
                    <x-input wire:model.defer="iva" type="number" name="iva" id="iva" required autofocus
                        autocomplete="iva" class="max-sm:w-full" />
                    <x-input-error for="iva"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Dirección') }}" for="direccion" />
                    <x-input wire:model.defer="direccion" type="text" name="direccion" id="direccion" required
                        autofocus autocomplete="direccion" class="max-sm:w-full" />
                    <x-input-error for="direccion"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Zona') }}" for="zona" />
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
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Supervisor') }}" for="supervisor" />
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
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Gerente') }}" for="gerente" />
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
        </fieldset>
    </x-slot>
    <x-slot name="btn_action">
        <div x-data="{
            combustibles: [{ tipo: '', clave: '', capacidad: '', prom_venta: '', dif_vr_fisico: '', minimo: '', alerta: '' }],
            dispensarios: [{ marca: '', serie: '', version_cpu: '', modelo: '', mangueras: '', flujo: '' }],
        
            addCombustible() {
                this.combustibles.push({ tipo: '', clave: '', capacidad: '', prom_venta: '', dif_vr_fisico: '', minimo: '', alerta: '' });
            },
            delCombustible(index) {
                this.combustibles.splice(index, 1);
            },
            addDispensario() {
                this.dispensarios.push({ marca: '', serie: '', version_cpu: '', modelo: '', mangueras: '', flujo: '' });
            },
            delDispensario(index) {
                this.dispensarios.splice(index, 1);
            },
            newEstacion() {
                const datos = this.combustibles.filter((item) => item.tipo != '');
                const datosDispensarios = this.dispensarios.filter((item) => item.marca != '');
                $wire.set('combustibles', datos);
                $wire.set('dispensarios', datosDispensarios);
                $wire.addEstacion();
            }
        }">

            {{-- COMBUSTIBLES --}}
            <fieldset class="border dark:border-gray-500 p-2 text-left mb-4 overflow-hidden max-h-60 overflow-y-auto">
                <legend class="font-bold">Datos de Combustibles</legend>
                <x-input-error for="combustibles"></x-input-error>
                <div class="flex flex-col justify-evenly gap-2">
                    <template x-for="(combustible,index) in combustibles" :key="index">
                        {{-- dentro de un template sólo puede existir un contenedor div padre --}}
                        <div>
                            <div class="flex gap-2 justify-around items-end">
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Tipo de combustible') }}" for="tipo"
                                        class="before:content-['*'] before:text-red-500" />
                                    <select name="tipo" id="tipo" x-model="combustible.tipo"
                                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                                        <option hidden value="" selected>Tipo de combustible</option>
                                        <option value="MAGNA">MAGNA</option>
                                        <option value="PREMIUM">PREMIUM</option>
                                        <option value="DIESEL">DIESEL</option>
                                    </select>
                                </div>
                                <template x-if="index >0">
                                    <button @click="delCombustible(index)"
                                        class="rounded-md bg-red-700 text-white h-fit w-fit p-2">
                                        <x-icons.trash />
                                    </button>
                                </template>
                            </div>
                            <div class="flex flex-wrap justify-evenly gap-2 py-2 border-b dark:border-gray-500">
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Capacidad') }}" for="capacidad" class="before:content-['*'] before:text-red-500"/>
                                    <x-input x-model="combustible.capacidad" type="number" name="capacidad"
                                        id="capacidad" required autofocus autocomplete="capacidad"
                                        class="max-sm:w-full" />
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Promedio de venta') }}" for="prom_venta" />
                                    <x-input x-model="combustible.prom_venta" type="number" name="prom_venta"
                                        id="prom_venta" required autofocus autocomplete="prom_venta"
                                        class="max-sm:w-full" />
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Diferencia Veeder Root y Fisico') }}"
                                        for="dif_vr_fisico" />
                                    <x-input x-model="combustible.dif_vr_fisico" type="number" name="dif_vr_fisico"
                                        id="dif_vr_fisico" required autofocus autocomplete="dif_vr_fisico"
                                        class="max-sm:w-full" />
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Combustible Mínimo') }}" for="minimo" />
                                    <x-input x-model="combustible.minimo" type="number" name="minimo"
                                        id="minimo" required autofocus autocomplete="minimo"
                                        class="max-sm:w-full" />
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Días de Alerta') }}" for="alerta" />
                                    <x-input x-model="combustible.alerta" type="number" name="alerta"
                                        id="alerta" required autofocus autocomplete="alerta"
                                        class="max-sm:w-full" />
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="mt-2">
                    <button @click="addCombustible()" class="rounded-md bg-green-700 text-white px-2 py-1">
                        Añadir Combustible
                    </button>
                </div>
            </fieldset>

            {{-- DISPENSARIOS --}}
            <div x-data="{ optionSelected: false }">
                <div class="flex items-center justify-start">
                    <x-input type="checkbox" id="optionSelected" x-model="optionSelected" />
                    <label for="optionSelected">Añadir Dispensarios</label>
                </div>
    
                <fieldset class="border dark:border-gray-500 p-2 text-left mb-4 overflow-hidden max-h-60 overflow-y-auto"
                    x-show="optionSelected">
                    <legend class="font-bold">Datos de Dispensarios</legend>
                    <x-input-error for="dispensarios"></x-input-error>
                    <div class="flex flex-col justify-evenly gap-2">
                        <template x-for="(dispensario, index) in dispensarios" :key="index">
                            <div>
                                <div class="flex gap-2 justify-around items-end">
                                    <div class="max-sm:w-full">
                                        <x-label value="{{ __('Marca') }}" for="marca" />
                                        <select name="marca" id="marca" x-model="dispensario.marca"
                                            class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                                            <option hidden value="" selected>Marca</option>
                                            <option value="BENNET">BENNET</option>
                                            <option value="GILBARCO">GILBARCO</option>
                                            <option value="OPW">OPW</option>
                                            <option value="SGS">SGS</option>
                                            <option value="WAYNE">WAYNE</option>
                                        </select>
                                    </div>
                                    <template x-if="index >0">
                                        <button @click="delDispensario(index)"
                                            class="rounded-md bg-red-700 text-white h-fit w-fit p-2">
                                            <x-icons.trash />
                                        </button>
                                    </template>
                                </div>
                                <div class="flex flex-wrap justify-evenly gap-2 py-2 border-b dark:border-gray-500">
                                    <div class="max-sm:w-full">
                                        <x-label value="{{ __('Modelo') }}" for="modelo" />
                                        <x-input x-model="dispensario.modelo" type="text" name="modelo"
                                            id="modelo" required autofocus autocomplete="modelo"
                                            class="max-sm:w-full" />
                                    </div>
                                    <div class="max-sm:w-full">
                                        <x-label value="{{ __('Serie') }}" for="serie" />
                                        <x-input x-model="dispensario.serie" type="text" name="serie"
                                            id="serie" required autofocus autocomplete="serie"
                                            class="max-sm:w-full" />
                                    </div>
                                    <div class="max-sm:w-full">
                                        <x-label value="{{ __('Cant. Mangueras') }}" for="mangueras" />
                                        <x-input x-model="dispensario.mangueras" type="number" name="mangueras"
                                            id="mangueras" required autofocus autocomplete="mangueras"
                                            class="max-sm:w-full" />
                                    </div>
                                    <div class="max-sm:w-full">
                                        <x-label value="{{ __('Flujo') }}" for="flujo" />
                                        <select name="flujo" id="flujo" x-model="dispensario.flujo"
                                            class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                                            <option hidden value="" selected>Flujo</option>
                                            <option value="NORMAL">NORMAL</option>
                                            <option value="ALTO">ALTO</option>
                                            <option value="NORMAL/ALTO">NORMAL/ALTO</option>
                                        </select>
                                    </div>
                                    <div class="max-sm:w-full">
                                        <x-label value="{{ __('Versión CPU') }}" for="version_cpu" />
                                        <x-input x-model="dispensario.version_cpu" type="text" name="version_cpu"
                                            id="version_cpu" required autofocus autocomplete="version_cpu"
                                            class="max-sm:w-full" />
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="mt-2">
                        <button @click="addDispensario()" class="rounded-md bg-green-700 text-white px-2 py-1">
                            Añadir Dispensario
                        </button>
                    </div>
                </fieldset>
            </div>
           
            <x-danger-button class="mr-2" @click="newEstacion()" wire:loading.attr="disabled">
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
                    <span class="sr-only">Registrando...</span>
                </div>
                Aceptar
            </x-danger-button>
            <x-secondary-button @click="modelOpen = false" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
        </div>
    </x-slot>
</x-modal-create>
