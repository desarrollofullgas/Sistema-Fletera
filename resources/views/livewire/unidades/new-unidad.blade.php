<x-modal-create button_tittle="Añadir unidad" tittle="Nueva unidad de transporte">
    <x-slot name="content">
        <fieldset class="border dark:border-gray-500 p-2 overflow-hidden max-h-60 overflow-y-auto">
            <legend>Datos de unidad</legend>
            <div class="flex flex-wrap justify-evenly gap-2">
                <div class="w-full">
                    <x-label value="{{ __('Línea de transporte') }}" for="linea" class="before:content-['*'] before:text-red-500"/>
                    <select name="linea" id="linea" wire:model.defer="linea" class="w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                        <option hidden value="" selected>Línea de transporte</option>
                        @foreach ($lineas as $linea)
                            <option value="{{$linea->id}}">{{$linea->name}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="capacidad"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Número de unidad') }}" for="tractor" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="tractor" type="text" name="tractor"
                        id="tractor" required autofocus autocomplete="tractor" class="max-sm:w-full"/>
                    <x-input-error for="tractor"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Placa') }}" for="placa" />
                    <x-input wire:model.defer="placa" type="text" name="placa"
                        id="placa" required autofocus autocomplete="placa" class="max-sm:w-full"/>
                    <x-input-error for="placa"></x-input-error>
                    </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Marca') }}" for="marca" />
                    <x-input wire:model.defer="marca" type="text" name="marca"
                        id="marca" required autofocus autocomplete="marca" class="max-sm:w-full"/>
                    <x-input-error for="marca"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Modelo') }}" for="modelo" />
                    <x-input wire:model.defer="modelo" type="text" name="modelo"
                        id="modelo" required autofocus autocomplete="modelo" class="max-sm:w-full"/>
                    <x-input-error for="modelo"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Serie') }}" for="serie" />
                    <x-input wire:model.defer="serie" type="text" name="serie"
                        id="serie" required autofocus autocomplete="serie" class="max-sm:w-full"/>
                    <x-input-error for="serie"></x-input-error>
                </div>
                <div class="max-sm:w-full">
                    <x-label value="{{ __('Capacidad general') }}" for="capacidad" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="capacidad" type="number" name="capacidad"
                        id="capacidad" required autofocus autocomplete="capacidad" class="max-sm:w-full"/>
                    <x-input-error for="capacidad"></x-input-error>
                </div>
            </div>
        </fieldset>
    </x-slot>
    <x-slot name="btn_action">
        <div x-data="{pipas:[{tonel:'',serie:'',placa:'',marca:'',modelo:''}],
            addPipa(){
                this.pipas.push({tonel:'',serie:'',placa:'',marca:'',modelo:''});
            },
            delPipa(index){
                this.pipas.splice(index,1);
            },
            newUnidad(){
                const datos=this.pipas.filter((item)=> item.tonel!='');
                $wire.set('pipas',datos);
                $wire.addUnidad();
            }}">
            <fieldset class="border dark:border-gray-500 p-2 text-left mb-4 overflow-hidden max-h-60 overflow-y-auto">
                <legend>Datos de Pipas</legend>
                <x-input-error for="pipas"></x-input-error>
                <div class="flex flex-col justify-evenly gap-2">
                    <template x-for="(pipa,index) in pipas" :key="index">
                        {{-- dengtro de un template sólo puede existir un contenedor div padre --}}
                        <div>
                            <div class="flex gap-2 justify-around items-end">
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Tipo de tonel') }}" for="linea" class="before:content-['*'] before:text-red-500" />
                                    <select name="linea" id="linea" x-model="pipa.tonel" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                                        <option hidden value="" selected>Tipo de tonel</option>
                                        <option value="T1">T1</option>
                                        <option value="T1-T2">T1-T2</option>
                                    </select>
                                </div>
                                <template x-if="index >0">
                                    <button @click="delPipa(index)" class="rounded-md bg-red-700 text-white h-fit w-fit p-2">
                                        <x-icons.trash/>
                                    </button>
                                </template>
                            </div>
                            <div class="flex flex-wrap justify-evenly gap-2 py-2 border-b dark:border-gray-500">
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Placa') }}" for="placa" />
                                    <x-input x-model="pipa.placa" type="text" name="placa"
                                        id="placa" required autofocus autocomplete="placa" class="max-sm:w-full"/>
                                    <x-input-error for="placa"></x-input-error>
                                    </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Marca') }}" for="marca" />
                                    <x-input x-model="pipa.marca" type="text" name="marca"
                                        id="marca" required autofocus autocomplete="marca" class="max-sm:w-full"/>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Modelo') }}" for="modelo" />
                                    <x-input x-model="pipa.modelo" type="text" name="modelo"
                                        id="modelo" required autofocus autocomplete="modelo" class="max-sm:w-full"/>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Serie') }}" for="serie" />
                                    <x-input x-model="pipa.serie" type="text" name="serie"
                                        id="serie" required autofocus autocomplete="serie" class="max-sm:w-full"/>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="mt-2">
                    <button @click="addPipa()" class="rounded-md bg-green-700 text-white px-2 py-1">
                        Añadir Pipa
                    </button>
                </div>
            </fieldset>
            <x-danger-button class="mr-2" @click="newUnidad()" wire:loading.attr="disabled">
                <div role="status" wire:loading wire:target="addLinea">
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
