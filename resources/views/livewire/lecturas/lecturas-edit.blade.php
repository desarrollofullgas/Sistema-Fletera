<x-modal-create tittle="" tipo="show" class="w-full">
    <x-slot name="button_tittle">
        <div class="flex items-center gap-2">
            <x-icons.edit/>
            <span>Editar</span>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-wrap justify-evenly gap-2" x-data="{
            estaciones: estas,
            detalles: detalles,
            tiposCombustible: comb,
            selectCombustible: [],
            tlitros: tlitros,
            filterCombustibles(event) {
                const selectedEstacionId = event.target.value;
                this.selectCombustible = this.tiposCombustible.filter(item => item.estacion_id == selectedEstacionId);
            },
            addDetalle() {
                this.detalles.push({ tipo: '', veeder: '', fisico: '', vperiferico: '', velectronica: '', vodometro: '' });
            },
            delDetalle(index) {
                this.detalles.splice(index, 1);
            },
            calculateTotalLitros() {
                this.tlitros = this.detalles.reduce((total, detalle) => total + parseFloat(detalle.velectronica || 0), 0);
            },
            updateDetalle() {
                const datos = this.detalles.filter((item) => item.tipo != '');
                $wire.set('detalles', datos);
                $wire.updateLectura();
            },
            
        }">
            <div class="w-full">
                <x-label for="estacion" value="Selecciona una estación" />
                <select wire:model="estacionId" id="estacion" @change="filterCombustibles(event)">
                    <option value="">Seleccione una estación</option>
                    <template x-for="estacion in estaciones">
                        <option x-bind:value="estacion.id" x-text="estacion.name"></option>
                    </template>
                </select>
            </div>
            <fieldset class="border p-2 text-left mb-4 overflow-hidden max-h-60 overflow-y-auto">
                <legend class="font-bold">Datos de Combustible</legend>
                <div class="flex flex-col justify-evenly gap-2">
                    <template x-for="(detalle,index) in detalles" :key="index">
                        <div>
                            <div class="flex gap-2 justify-around items-end">
                                <div class="w-full">
                                    <x-label for="combustible" value="Selecciona un tipo de combustible" />
                                    <select id="combustible" x-model="detalle.tipo">
                                        <option value="">Seleccionar Tipo de Combustible</option>
                                        <template x-for="tipoCombustible in selectCombustible">
                                            <option x-bind:value="tipoCombustible.id" x-text="tipoCombustible.tipo"></option>
                                        </template>
                                    </select>
                                </div>
                                <template x-if="index > 0">
                                    <button @click="delDetalle(index)" class="rounded-md bg-red-700 text-white h-fit w-fit p-2">Eliminar</button>
                                </template>
                            </div>
                            <div class="flex flex-wrap justify-evenly gap-2 py-2 border-b">
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Venta Electrónica') }}" for="velectronica" />
                                    <x-input x-model="detalle.velectronica" type="text" name="velectronica" id="velectronica" required />
                                </div>
                                <!-- Agrega aquí los campos restantes -->
                            </div>
                        </div>
                    </template>
                </div>
                <div class="mt-2">
                    <button @click="addDetalle()" class="rounded-md bg-green-700 text-white px-2 py-1">Añadir</button>
                </div>
            </fieldset>
            <div class="w-full">
                <div class="flex flex-wrap justify-evenly gap-2 mb-2">
                    <div class="max-sm:w-full">
                        <x-label :value="'Venta Total en Litros'" for="tlitros" />
                        <x-input wire:model.defer="tlitros" type="number" :name="'tlitros'" :id="'tlitros'" required />
                    </div>
                    <div class="max-sm:w-full">
                        <x-label :value="'Venta Total en Pesos'" for="tpesos" />
                        <x-input wire:model.defer="tpesos" type="number" :name="'tpesos'" :id="'tpesos'" required />
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="btn_action">
        <x-danger-button @click="updateDetalle()">
            Aceptar
        </x-danger-button>
        <x-secondary-button @click="modelOpen = false" wire:loading.attr="disabled">
            Cerrar
        </x-secondary-button>
    </x-slot>
</x-modal-create>