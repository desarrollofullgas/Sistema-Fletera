<div>
    <div class="p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <fieldset class="border dark:border-gray-500 p-2">
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
            @if (count($toneles) > 0)    
                <fieldset class="border-t mt-3">
                    <legend class="mx-2 px-1">Toneles registrados</legend>
                    <div class="">
                        @foreach ($toneles as $key=>$tonel)
                            <div class="flex flex-wrap justify-evenly items-center gap-2 py-2 border-b dark:border-gray-500">
                                @if ($key > 0)    
                                    <button wire:click="tonelDelete({{$tonel['id']}})" class="rounded-md bg-red-700 text-white h-fit w-fit p-2">
                                        <x-icons.trash/>
                                    </button>
                                @endif
                                <div class="flex gap-2 justify-around items-end">
                                    <div class="max-sm:w-full">
                                        <x-label value="{{ __('Tipo de tonel') }}" for="linea" class="before:content-['*'] before:text-red-500" />
                                        <select name="linea" id="linea" wire:model.defer="toneles.{{$key}}.tipo" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                                            <option hidden value="" selected>Tipo de tonel</option>
                                            <option value="T1">T1</option>
                                            <option value="T1-T2">T1-T2</option>
                                        </select>
                                        <x-input-error for="toneles.{{$key}}.tipo"></x-input-error>
                                    </div>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Placa') }}" for="placa" />
                                    <x-input  wire:model.defer="toneles.{{$key}}.placa" type="text" name="placa"
                                        id="placa" required autofocus autocomplete="placa" class="max-sm:w-full"/>
                                    <x-input-error for="placa"></x-input-error>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Marca') }}" for="marca" />
                                    <x-input wire:model.defer="toneles.{{$key}}.marca" type="text" name="marca"
                                        id="marca" required autofocus autocomplete="marca" class="max-sm:w-full"/>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Modelo') }}" for="modelo" />
                                    <x-input  wire:model.defer="toneles.{{$key}}.modelo" type="text" name="modelo"
                                        id="modelo" required autofocus autocomplete="modelo" class="max-sm:w-full"/>
                                </div>
                                <div class="max-sm:w-full">
                                    <x-label value="{{ __('Serie') }}" for="serie" />
                                    <x-input  wire:model.defer="toneles.{{$key}}.serie" type="text" name="serie" id="serie" required autofocus autocomplete="serie" class="max-sm:w-full"/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
            @endif
        </fieldset>
    </div>
    <div class="mt-3 p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1" x-data="{pipas:[{tonel:'',serie:'',placa:'',marca:'',modelo:''}],
            addPipa(){
                this.pipas.push({tonel:'',serie:'',placa:'',marca:'',modelo:''});
            },
            delPipa(index){
                this.pipas.splice(index,1);
            },
            updateUnidad(){
                const datos=this.pipas.filter((item)=> item.tonel!='');
                $wire.set('pipas',datos);
                $wire.unidadUpdate();
            }}">
        <fieldset class="border dark:border-gray-500 p-2 text-left mb-4 overflow-hidden overflow-y-auto max-h-96">
            <legend class="px-1">Registrar toneles</legend>
            <x-input-error for="pipas"></x-input-error>
            <div class="flex flex-col justify-evenly gap-2">
                <template x-for="(pipa,index) in pipas" :key="index">
                    {{-- dengtro de un template sólo puede existir un contenedor div padre --}}
                    <div>
                        <div class="flex flex-wrap justify-evenly items-center gap-2 py-2 border-b dark:border-gray-500">
                            <template x-if="index >0">
                                <button @click="delPipa(index)" class="rounded-md bg-red-700 text-white h-fit w-fit p-2">
                                    <x-icons.trash/>
                                </button>
                            </template>
                            <div class="max-sm:w-full">
                                <x-label value="{{ __('Tipo de tonel') }}" for="linea" class="before:content-['*'] before:text-red-500" />
                                <select name="linea" id="linea" x-model="pipa.tonel" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                                    <option hidden value="" selected>Tipo de tonel</option>
                                    <option value="T1">T1</option>
                                    <option value="T1-T2">T1-T2</option>
                                </select>
                            </div>
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
                    Añadir tonel
                </button>
            </div>
        </fieldset>
        <div>
            <x-danger-button class="mr-2" @click="updateUnidad()" wire:loading.attr="disabled">
                <div role="status" wire:loading wire:target="unidadUpdate">
                    <x-icons.spin/>
                    <span class="sr-only">Registrando...</span>
                </div>
                Guardar cambios
            </x-danger-button>
        </div>
    </div>
</div>
