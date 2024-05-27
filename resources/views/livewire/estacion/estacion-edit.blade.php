<div>
    <div class="p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <fieldset class="border dark:border-gray-500 p-2">
            <legend class="font-bold">Datos de la Estación</legend>
            <div class="flex flex-wrap justify-evenly gap-2">
                <div class="w-full">
                    <x-label value="{{ __('Nombre') }}" for="name" class="before:content-['*'] before:text-red-500" />
                    <x-input wire:model.defer="name"
                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('name') ? 'is-invalid' : '' }}"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error for="name"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Número') }}" for="numero"
                        class="before:content-['*'] before:text-red-500" />
                    <x-input wire:model.defer="numero"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('numero') ? 'is-invalid' : '' }}"
                        type="text" name="numero" :value="old('numero')" required autofocus autocomplete="numero" />
                    <x-input-error for="numero"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Razón Social') }}" for="razon" />
                    <textarea wire:model.defer="razon"
                        class=" w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 {{ $errors->has('razon') ? 'is-invalid' : '' }} "
                        name="razon">
                            </textarea>
                    <x-input-error for="razon"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('RFC') }}" for="rfc" />
                    <x-input wire:model.defer="rfc"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('rfc') ? 'is-invalid' : '' }}"
                        type="text" name="rfc" :value="old('rfc')" required autofocus autocomplete="rfc" />
                    <x-input-error for="rfc"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('SIIC') }}" for="siic" />
                    <x-input wire:model="siic"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('siic') ? 'is-invalid' : '' }}"
                        type="text" name="siic" :value="old('siic')" autocomplete="siic" />
                    <x-input-error for="siic"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('IVA') }}" for="iva" />
                    <x-input wire:model="iva"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('iva') ? 'is-invalid' : '' }}"
                        type="text" name="iva" :value="old('iva')" required autofocus autocomplete="iva" />
                    <x-input-error for="iva"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Permiso CRE') }}" for="cre" />
                    <x-input wire:model="cre"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('cre') ? 'is-invalid' : '' }}"
                        type="text" name="cre" :value="old('cre')" autocomplete="cre" />
                    <x-input-error for="cre"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Propietario') }}" for="propietario" />
                    <x-input wire:model="propietario"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('propietario') ? 'is-invalid' : '' }}"
                        type="text" name="propietario" :value="old('propietario')" autocomplete="propietario" />
                    <x-input-error for="propietario"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Dirección') }}" for="direccion"
                        class="before:content-['*'] before:text-red-500" />
                    <textarea wire:model.defer="direccion"
                        class=" w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 {{ $errors->has('direccion') ? 'is-invalid' : '' }} "
                        name="direccion">
                            </textarea>
                    <x-input-error for="direccion"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Zona') }}" for="zona"
                        class="before:content-['*'] before:text-red-500" />
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
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Supervisor') }}" for="supervisor"
                        class="before:content-['*'] before:text-red-500" />
                    <select id="supervisor" wire:model.defer="supervisor"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1{{ $errors->has('supervisor') ? 'is-invalid' : '' }}"
                        name="supervisor" required aria-required="true">
                        @if ($this->isSuper == null)
                            <option value="" hidden>Seleccionar
                                Supervisor</option>
                        @else
                            <option hidden value="">Seleccionar
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
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Gerente') }}" for="gerente"
                        class="before:content-['*'] before:text-red-500" />
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
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Estado') }}" for="status"
                        class="before:content-['*'] before:text-red-500" />
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
            {{-- COMBUSTIBLES --}}
            @if (count($combustibles) > 0)
                <fieldset class="border-t mt-3">
                    <legend class="mx-2 px-1 font-bold">Detalles Combustible</legend>
                    <div>
                        @foreach ($combustibles as $key => $combustible)
                            <div
                                class="flex flex-wrap justify-evenly items-center gap-2 py-2 border-b dark:border-gray-500">
                                @if ($key > 0)
                                    <button wire:click="combustibleDelete({{ $combustible['id'] }})"
                                        class="rounded-md bg-red-700 text-white h-fit w-fit p-2">
                                        <x-icons.trash />
                                    </button>
                                @endif
                                <div class="flex gap-2 justify-around items-end">
                                    <div class="max-sm:w-full">
                                        <x-label value="{{ __('Tipo de combustible') }}" for="tipo"
                                            class="before:content-['*'] before:text-red-500" />
                                        <select name="tipo" id="tipo"
                                            wire:model.defer="combustibles.{{ $key }}.tipo"
                                            class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                                            <option hidden value="" selected>Tipo de combustible</option>
                                            @foreach ($productos as $producto)
                                                <option value={{$producto->id}} selected>{{$producto->tipo}}</option>
                                            @endforeach
                                            {{-- <option value="MAGNA"
                                                @if ($combustible['tipo'] == 'MAGNA') {{ 'selected' }} @endif>
                                                MAGNA</option>
                                            <option value="PREMIUM"
                                                @if ($combustible['tipo'] == 'PREMIUM') {{ 'selected' }} @endif>
                                                PREMIUM</option>
                                            <option value="DIESEL"
                                                @if ($combustible['tipo'] == 'DIESEL') {{ 'selected' }} @endif>
                                                DIESEL</option> --}}
                                        </select>
                                        <x-input-error for="combustibles.{{ $key }}.tipo"></x-input-error>
                                    </div>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Capacidad') }}" for="capacidad" />
                                    <x-input wire:model.defer="combustibles.{{ $key }}.capacidad"
                                        type="text" name="capacidad" id="capacidad" required autofocus
                                        autocomplete="capacidad" class="max-sm:w-full" />
                                    <x-input-error for="capacidad"></x-input-error>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Promedio de Venta') }}" for="prom_venta" />
                                    <x-input wire:model.defer="combustibles.{{ $key }}.prom_venta"
                                        type="text" name="prom_venta" id="prom_venta" required autofocus
                                        autocomplete="prom_venta" class="max-sm:w-full" />
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Diferencias entre el Veeder Root y Fisico') }}"
                                        for="dif_vr_fisico" />
                                    <x-input wire:model.defer="combustibles.{{ $key }}.dif_vr_fisico"
                                        type="text" name="dif_vr_fisico" id="dif_vr_fisico" required autofocus
                                        autocomplete="dif_vr_fisico" class="max-sm:w-full" />
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Combustible Mínimo en el Tanque') }}" for="minimo" />
                                    <x-input wire:model.defer="combustibles.{{ $key }}.minimo"
                                        type="text" name="minimo" id="minimo" required autofocus
                                        autocomplete="minimo" class="max-sm:w-full" />
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Alerta de Vencimiento de Existencias') }}"
                                        for="alerta" />
                                    <x-input wire:model.defer="combustibles.{{ $key }}.alerta"
                                        type="text" name="alerta" id="alerta" required autofocus
                                        autocomplete="alerta" class="max-sm:w-full" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
            @endif
            {{-- DISPENSARIOS --}}
            @if (count($dispensarios) > 0)
                <fieldset class="border-t mt-3">
                    <legend class="mx-2 px-1 font-bold">Detalles Dispensarios</legend>
                    <div>
                        @foreach ($dispensarios as $key => $dispensario)
                            <div
                                class="flex flex-wrap justify-evenly items-center gap-2 py-2 border-b dark:border-gray-500">
                                @if ($key > 0)
                                    <button wire:click="dispensarioDelete({{ $dispensario['id'] }})"
                                        class="rounded-md bg-red-700 text-white h-fit w-fit p-2">
                                        <x-icons.trash />
                                    </button>
                                @endif
                                <div class="flex gap-2 justify-around items-end">
                                    <div class="max-sm:w-full">
                                        <x-label value="{{ __('Marca Dispensario') }}" for="marca"
                                            class="before:content-['*'] before:text-red-500" />
                                        <select name="marca" id="marca"
                                            wire:model.defer="dispensarios.{{ $key }}.marca"
                                            class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                                            <option hidden value="" selected>Marca Dispensario</option>
                                            <option value="BENNET"
                                                @if ($dispensario['marca'] == 'BENNET') {{ 'selected' }} @endif>
                                                BENNET</option>
                                            <option value="GILBARCO"
                                                @if ($dispensario['marca'] == 'GILBARCO') {{ 'selected' }} @endif>
                                                GILBARCO</option>
                                            <option value="OPW"
                                                @if ($dispensario['marca'] == 'OPW') {{ 'selected' }} @endif>
                                                OPW</option>
                                                <option value="SGS"
                                                @if ($dispensario['marca'] == 'SGS') {{ 'selected' }} @endif>
                                                SGS</option>
                                            <option value="WAYNE"
                                                @if ($dispensario['marca'] == 'WAYNE') {{ 'selected' }} @endif>
                                                WAYNE</option>
                                        </select>
                                        <x-input-error for="dispensarios.{{ $key }}.marca"></x-input-error>
                                    </div>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Modelo') }}" for="modelo" />
                                    <x-input wire:model.defer="dispensarios.{{ $key }}.modelo"
                                        type="text" name="modelo" id="modelo" required autofocus
                                        autocomplete="modelo" class="max-sm:w-full" />
                                    <x-input-error for="modelo"></x-input-error>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Serie') }}" for="serie" />
                                    <x-input wire:model.defer="dispensarios.{{ $key }}.serie"
                                        type="text" name="serie" id="serie" required autofocus
                                        autocomplete="serie" class="max-sm:w-full" />
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Flujo Dispensario') }}"
                                        for="flujo" />
                                        <select name="flujo" id="flujo"
                                        wire:model.defer="dispensarios.{{ $key }}.flujo"
                                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                                        <option hidden value="" selected>Flujo Dispensario</option>
                                        <option value="NORMAL"
                                            @if ($dispensario['flujo'] == 'NORMAL') {{ 'selected' }} @endif>
                                            NORMAL</option>
                                        <option value="ALTO"
                                            @if ($dispensario['flujo'] == 'ALTO') {{ 'selected' }} @endif>
                                            ALTO</option>
                                        <option value="ALTO/NORMAL"
                                            @if ($dispensario['flujo'] == 'ALTO/NORMAL') {{ 'selected' }} @endif>
                                            ALTO/NORMAL</option>
                                    </select>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Catn. Total Mangueras') }}" for="mangueras" />
                                    <x-input wire:model.defer="dispensarios.{{ $key }}.mangueras"
                                        type="number" name="mangueras" id="mangueras" required autofocus
                                        autocomplete="mangueras" class="max-sm:w-full" />
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Versión de CPU') }}"
                                        for="version_cpu" />
                                    <x-input wire:model.defer="dispensarios.{{ $key }}.version_cpu"
                                        type="text" name="version_cpu" id="version_cpu" required autofocus
                                        autocomplete="version_cpu" class="max-sm:w-full" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
            @endif
        </fieldset>
    </div>
    <div class="mt-3 p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1"
        x-data="{productos:lista,
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
            updateEstacion() {
                const datos = this.combustibles.filter((item) => item.tipo != '');
                const datosDispensarios = this.dispensarios.filter((item) => item.marca != '');
                $wire.set('newCombustibles', datos);
                $wire.set('newDispensarios', datosDispensarios);
                $wire.estacionUpdate();
            }
        }">
        {{-- Obtenemos la lista generada en el mount para usarla en AlpineJS --}}
        <script wire:ignore>
            const lista={!!json_encode($productos)!!}
        </script>
        {{-- Aañadir Combustibles --}}
        <fieldset class="border dark:border-gray-500 p-2 text-left mb-4 overflow-hidden overflow-y-auto max-h-96">
            <legend class="px-1 font-bold">Añadir Combustible</legend>
            <x-input-error for="combustibles"></x-input-error>
            <div class="flex flex-col justify-evenly gap-2">
                <template x-for="(combustible,index) in combustibles" :key="index">
                    {{-- dentro de un template sólo puede existir un contenedor div padre --}}
                    <div>
                        <div
                            class="flex flex-wrap justify-evenly items-center gap-2 py-2 border-b dark:border-gray-500">
                            <template x-if="index >0">
                                <button @click="delCombustible(index)"
                                    class="rounded-md bg-red-700 text-white h-fit w-fit p-2">
                                    <x-icons.trash />
                                </button>
                            </template>
                            <div class="max-sm:w-full">
                                <x-label value="{{ __('Tipo de Combustible') }}" for="tipo"
                                    class="before:content-['*'] before:text-red-500" />
                                <select name="tipo" id="tipo" x-model="combustible.tipo"
                                    class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                                    <option hidden value="" selected>Tipo de combustible</option>
                                    <template x-for="producto in productos">
                                        <option :value="producto.id" x-text="producto.tipo"></option>
                                    </template>
                                    {{-- <option value="MAGNA">MAGNA</option>
                                    <option value="PREMIUM">PREMIUM</option>
                                    <option value="DIESEL">DIESEL</option> --}}
                                </select>
                            </div>
                            <div class="max-sm:w-full">
                                <x-label value="{{ __('Capacidad') }}" for="capacidad" />
                                <x-input x-model="combustible.capacidad" type="number" name="capacidad"
                                    id="capacidad" required autofocus autocomplete="capacidad"
                                    class="max-sm:w-full" />
                                <x-input-error for="capacidad"></x-input-error>
                            </div>
                            <div class="max-sm:w-full">
                                <x-label value="{{ __('Promedio de venta') }}" for="prom_venta" />
                                <x-input x-model="combustible.prom_venta" type="number" name="prom_venta"
                                    id="prom_venta" required autofocus autocomplete="prom_venta"
                                    class="max-sm:w-full" />
                            </div>
                            <div class="max-sm:w-full">
                                <x-label value="{{ __('Diferencia Veeder Root y Fisico') }}" for="dif_vr_fisico" />
                                <x-input x-model="combustible.dif_vr_fisico" type="number" name="dif_vr_fisico"
                                    id="dif_vr_fisico" required autofocus autocomplete="dif_vr_fisico"
                                    class="max-sm:w-full" />
                            </div>
                            <div class="max-sm:w-full">
                                <x-label value="{{ __('Combustible Mínimo') }}" for="minimo" />
                                <x-input x-model="combustible.minimo" type="number" name="minimo" id="minimo"
                                    required autofocus autocomplete="minimo" class="max-sm:w-full" />
                            </div>
                            <div class="max-sm:w-full">
                                <x-label value="{{ __('Días de Alerta') }}" for="alerta" />
                                <x-input x-model="combustible.alerta" type="number" name="alerta" id="alerta"
                                    required autofocus autocomplete="alerta" class="max-sm:w-full" />
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <div class="mt-2">
                <button @click="addCombustible()" class="rounded-md bg-green-700 text-white px-2 py-1">
                    Añadir
                </button>
            </div>
        </fieldset>
        {{-- Añadir Dispensarios --}}
        <fieldset class="border dark:border-gray-500 p-2 text-left mb-4 overflow-hidden overflow-y-auto max-h-96">
            <legend class="px-1 font-bold">Añadir Dispensario</legend>
            <x-input-error for="dispensarios"></x-input-error>
            <div class="flex flex-col justify-evenly gap-2">
                <template x-for="(dispensario,index) in dispensarios" :key="index">
                    {{-- dentro de un template sólo puede existir un contenedor div padre --}}
                    <div>
                        <div
                            class="flex flex-wrap justify-evenly items-center gap-2 py-2 border-b dark:border-gray-500">
                            <template x-if="index >0">
                                <button @click="delDispensario(index)"
                                    class="rounded-md bg-red-700 text-white h-fit w-fit p-2">
                                    <x-icons.trash />
                                </button>
                            </template>
                            <div class="max-sm:w-full">
                                <x-label value="{{ __('Marca Dispensario') }}" for="marca"
                                    class="before:content-['*'] before:text-red-500" />
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
                    Añadir
                </button>
            </div>
        </fieldset>
        <div>
            <x-danger-button class="mr-2" @click="updateEstacion()" wire:loading.attr="disabled">
                <div role="status" wire:loading wire:target="estacionUpdate">
                    <x-icons.spin />
                    <span class="sr-only">Registrando...</span>
                </div>
                Guardar cambios
            </x-danger-button>
        </div>
    </div>
</div>
