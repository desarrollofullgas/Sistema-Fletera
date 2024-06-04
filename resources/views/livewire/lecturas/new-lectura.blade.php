<x-modal-create button_tittle="Nueva Lectura" tittle="REGISTRO DE VENTAS">
    <x-slot name="content">
        <div class="flex flex-wrap justify-evenly gap-2" x-data="{
            estaciones: estas,
            detalles: [{ tipo: '', veeder: '', fisico: '', vperiferico: '', velectronica: '', vodometro: '' }],
            tiposCombustible: comb,
            selectCombustible: [],
            filterCombustibles(event) {
                const selectedEstacionId = event.target.value;
                this.selectCombustible = this.tiposCombustible.filter(item => item.estacion_id == selectedEstacionId);
                console.log(this.tiposCombustible, selectedEstacionId);
            },
            addDetalle() {
                this.detalles.push({ tipo: '', veeder: '', fisico: '', vperiferico: '', velectronica: '', vodometro: '' });
            },
            delDetalle(index) {
                this.detalles.splice(index, 1);
            },
            newDetalle() {
                const datos = this.detalles.filter((item) => item.tipo != '');
                $wire.set('detalles', datos);
                $wire.addLectura();
            }
        }">
            <div class="w-full">
                <x-label for="estacion" value="Selecciona una estación" />
                <select wire:model="estacionId" id="estacion" @change="filterCombustibles(event)"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm1 dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">
                    <option value="">Seleccione una estación</option>
                    <template x-for="estacion in estaciones">
                        <option x-bind:value="estacion.id" x-text="estacion.name"></option>
                    </template>
                </select>
                <x-input-error for="estacionId"></x-input-error>
            </div>
            <fieldset class="border dark:border-gray-500 p-2 text-left mb-4 overflow-hidden max-h-60 overflow-y-auto">
                <legend class="font-bold">Datos de Combustible</legend>
                <x-input-error for="detalles"></x-input-error>
                <div class="flex flex-col justify-evenly gap-2">
                    <template x-for="(detalle,index) in detalles" :key="index">
                        {{-- dentro de un template sólo puede existir un contenedor div padre --}}
                        <div>
                            <div class="flex gap-2 justify-around items-end">
                                <div  class="w-full">
                                    <x-label for="combustible" value="Selecciona un tipo de combustible" />
                                    <select id="combustible" x-model="detalle.tipo"
                                            class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                                        <option value="">Seleccionar Tipo de Combustible</option>
                                        <template x-for="tipoCombustible in selectCombustible">
                                            <option x-bind:value="tipoCombustible.id" x-text="tipoCombustible.tipo"></option>
                                        </template>
                                    </select>
                                </div>
                                <template x-if="index >0">
                                    <button @click="delDetalle(index)"
                                        class="rounded-md bg-red-700 text-white h-fit w-fit p-2">
                                        <x-icons.trash />
                                    </button>
                                </template>
                            </div>
                            <div class="flex flex-wrap justify-evenly gap-2 py-2 border-b dark:border-gray-500">
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Venta Electrónica') }}" for="velectronica" />
                                    <x-input x-model="detalle.velectronica" type="text" name="velectronica"
                                        id="velectronica" required autocomplete="velectronica" class="max-sm:w-full" />
                                    <x-input-error for="velectronica"></x-input-error>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Venta Odómetro') }}" for="vodometro" />
                                    <x-input x-model="detalle.vodometro" type="text" name="vodometro" id="vodometro"
                                        required autocomplete="vodometro" class="max-sm:w-full" />
                                    <x-input-error for="vodometro"></x-input-error>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Venta Périfericos') }}" for="vperiferico" />
                                    <x-input x-model="detalle.vperiferico" type="text" name="vperiferico"
                                        id="vperiferico" required autocomplete="vperiferico" class="max-sm:w-full" />
                                    <x-input-error for="vperiferico"></x-input-error>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Veeder Root') }}" for="veeder" />
                                    <x-input x-model="detalle.veeder" type="text" name="veeder" id="veeder"
                                        required autocomplete="veeder" class="max-sm:w-full" />
                                    <x-input-error for="veeder"></x-input-error>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Fisico') }}" for="fisico" />
                                    <x-input x-model="detalle.fisico" type="text" name="fisico" id="fisico"
                                        required autocomplete="fisico" class="max-sm:w-full" />
                                    <x-input-error for="fisico"></x-input-error>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="mt-2">
                    <button @click="addDetalle()" class="rounded-md bg-green-700 text-white px-2 py-1">
                        Añadir
                    </button>
                </div>
                <script>
                    const estas = {!! json_encode($estaciones) !!};
                    
                    const comb = {!! json_encode($tiposCombustible) !!};
                </script>
            </fieldset>
            <div class="w-full">
                <div class="flex flex-wrap justify-evenly gap-2 mb-2">
                    <div class="max-sm:w-full">
                        <x-label :value="'Venta Total en Litros'" for="tlitros" />
                        <x-input wire:model.defer="tlitros" type="number" :name="'tlitros'" :id="'tlitros'" required
                            autofocus autocomplete="off" class="w-full" />
                        <x-input-error :for="'tlitros'"></x-input-error>
                    </div>
                    <div class="max-sm:w-full">
                        <x-label :value="'Venta Total en Pesos'" for="tpesos" />
                        <x-input wire:model.defer="tpesos" type="number" :name="'tpesos'" :id="'tpesos'" required
                            autofocus autocomplete="off" class="w-full" />
                        <x-input-error :for="'tpesos'"></x-input-error>
                    </div>
                </div>
                <br>
                <div class="flex flex-wrap gap-2 justify-center">
                    <x-danger-button @click="newDetalle()" wire:loading.attr="disabled">
                        <div role="status" wire:loading wire:target="addLectura">
                            <x-icons.spin/>
                            <span class="sr-only">Registrando...</span>
                        </div>
                        Aceptar
                    </x-danger-button>
                    <x-secondary-button @click="modelOpen = false" wire:loading.attr="disabled">
                        Cancelar
                    </x-secondary-button>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="btn_action">
        
    </x-slot>
</x-modal-create>
