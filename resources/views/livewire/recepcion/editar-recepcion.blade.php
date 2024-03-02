<div>
    <div class="p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <fieldset class="border dark:border-gray-500 p-2 rounded-md">
            <legend class="text-xl px-2 bg-dark-eval-0 text-gray-200 rounded-md">Datos generales</legend>
            <div>
                <div class="pt-2 flex flex-wrap justify-evenly items-center gap-3">
                    <div>
                        <x-label value="{{ __('Fecha de la factura') }}" for="fFactura" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="fFactura" type="date" name="fFactura"
                            id="fFactura" required autofocus autocomplete="fFactura" class="max-sm:w-full"/>
                        <x-input-error for="fFactura"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('No. factura') }}" for="nFactura" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="nFactura" type="number" name="nFactura"
                            id="nFactura" required autofocus autocomplete="nFactura" class="max-sm:w-full"/>
                        <x-input-error for="nFactura"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Litros facturados') }}" for="ltsFact" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="ltsFact" type="number" name="ltsFact"
                            id="ltsFact" required autofocus autocomplete="ltsFact" class="max-sm:w-full"/>
                        <x-input-error for="ltsFact"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Precio unitario') }}" for="precio" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="precio" type="number" name="precio"
                            id="precio" required autofocus autocomplete="precio" class="max-sm:w-full"/>
                        <x-input-error for="precio"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Sello TFG D') }}" for="tfgD" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="tfgD" type="text" name="tfgD"
                            id="tfgD" required autofocus autocomplete="tfgD" class="max-sm:w-full"/>
                        <x-input-error for="tfgD"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Sello TFG C') }}" for="tfgC" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="tfgC" type="text" name="tfgC"
                            id="tfgC" required autofocus autocomplete="tfgC" class="max-sm:w-full"/>
                        <x-input-error for="tfgC"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Sello retorno') }}" for="retorno" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="retorno" type="text" name="retorno"
                            id="retorno" required autofocus autocomplete="retorno" class="max-sm:w-full"/>
                        <x-input-error for="retorno"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Sello PEMEX') }}" for="pemex1" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="pemex1" type="text" name="pemex1"
                            id="pemex1" required autofocus autocomplete="pemex1" class="max-sm:w-full"/>
                        <x-input-error for="pemex1"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Sello PEMEX') }}" for="pemex2" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="pemex2" type="text" name="pemex2"
                            id="pemex2" required autofocus autocomplete="pemex2" class="max-sm:w-full"/>
                        <x-input-error for="pemex2"></x-input-error>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <br>
    <div class="p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <fieldset class="border dark:border-gray-500 p-2 rounded-md">
            <legend class="text-xl px-2 bg-dark-eval-0 text-gray-200 rounded-md">Datos de carga de combustible</legend>
            <div class="flex flex-wrap gap-4 justify-center items-center">
                <div>
                    <x-label value="{{ __('Ciza') }}" for="ciza" class="before:content-['*'] before:text-red-500"/>
                    <select name="ciza" id="ciza" wire:model.defer="ciza" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white">
                        <option value="0 cm" hidden selected>0 cm</option>
                        <option value="-5 cm">-5 cm</option>
                        <option value="-4 cm">-4 cm</option>
                        <option value="-3 cm">-3 cm</option>
                        <option value="-2 cm">-2 cm</option>
                        <option value="-1 cm">-1 cm</option>
                        <option value="0 cm">0 cm</option>
                        <option value="1 cm">1 cm</option>
                        <option value="2 cm">2 cm</option>
                        <option value="3 cm">3 cm</option>
                        <option value="4 cm">4 cm</option>
                        <option value="5 cm">5 cm</option>
                    </select>
                    <x-input-error for="ciza"></x-input-error>
                </div>
                <div>
                    <label for="party_op" class="flex justify-center items-center gap-1 w-fit cursor-pointer">
                        <input type="checkbox" name="party_op" id="party_op" wire:model.defer='party_op' class="rounded-full dark:bg-dark-eval-3 w-5 h-5">
                        <span>Participación del operador</span>
                    </label>
                </div>
            </div>
            <div class="mt-3">
                <h2 class="flex gap-2 justify-center items-center border-b py-1"><x-icons.calendar/>Hora y fecha</h2>
                <div class="pt-2 flex flex-wrap justify-evenly items-center gap-3">
                    <div>
                        <x-label value="{{ __('Hora llegada de pipa') }}" for="llegada" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="llegada" type="time" name="llegada"
                            id="llegada" required autofocus autocomplete="llegada" class="max-sm:w-full"/>
                        <x-input-error for="llegada"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Hora salida de pipa') }}" for="salida" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="salida" type="time" name="salida"
                            id="salida" required autofocus autocomplete="salida" class="max-sm:w-full"/>
                        <x-input-error for="salida"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Hora inicio descarga') }}" for="inicio" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="inicio" type="time" name="inicio"
                            id="inicio" required autofocus autocomplete="inicio" class="max-sm:w-full"/>
                        <x-input-error for="inicio"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Hora fin de descarga') }}" for="fin" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="fin" type="time" name="fin"
                            id="fin" required autofocus autocomplete="fin" class="max-sm:w-full"/>
                        <x-input-error for="fin"></x-input-error>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <h2 class="flex gap-2 justify-center items-center border-b py-1"><x-icons.cpu/>Existencias veeder root litros</h2>
                        <div class="pt-2 flex flex-wrap justify-evenly items-center gap-3">
                            <div>
                                <x-label value="{{ __('Antes de descarga') }}" for="exVrAntDesc" class="before:content-['*'] before:text-red-500"/>
                                <x-input wire:model.defer="exVrAntDesc" type="number" name="exVrAntDesc"
                                    id="exVrAntDesc" required autofocus autocomplete="exVrAntDesc" class="max-sm:w-full"/>
                                <x-input-error for="exVrAntDesc"></x-input-error>
                            </div>
                            <div>
                                <x-label value="{{ __('Después de descarga') }}" for="exVrDespDesc" class="before:content-['*'] before:text-red-500"/>
                                <x-input wire:model.defer="exVrDespDesc" type="number" name="exVrDespDesc"
                                    id="exVrDespDesc" required autofocus autocomplete="exVrDespDesc" class="max-sm:w-full"/>
                                <x-input-error for="exVrDespDesc"></x-input-error>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2 class="flex gap-2 justify-center items-center border-b py-1"><x-icons.pc/>Existencia física (vara aluminio) litros</h2>
                        <div class="pt-2 flex flex-wrap justify-evenly items-center gap-3">
                            <div>
                                <x-label value="{{ __('Antes de descarga') }}" for="exFisAntDesc" class="before:content-['*'] before:text-red-500"/>
                                <x-input wire:model.defer="exFisAntDesc" type="number" name="exFisAntDesc"
                                    id="exFisAntDesc" required autofocus autocomplete="exFisAntDesc" class="max-sm:w-full"/>
                                <x-input-error for="exFisAntDesc"></x-input-error>
                            </div>
                            <div>
                                <x-label value="{{ __('Después de descarga') }}" for="exFisDespDesc" class="before:content-['*'] before:text-red-500"/>
                                <x-input wire:model.defer="exFisDespDesc" type="number" name="exFisDespDesc"
                                    id="exFisDespDesc" required autofocus autocomplete="exFisDespDesc" class="max-sm:w-full"/>
                                <x-input-error for="exFisDespDesc"></x-input-error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h2 class="flex gap-2 justify-center items-center border-b py-1"><x-icons.cpu/>Veeder root</h2>
                <div class="pt-2 flex flex-wrap justify-evenly items-center gap-3">
                    <div>
                        <x-label value="{{ __('Aumento en bruto veeder') }}" for="aumBrVr" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="aumBrVr" type="number" name="aumBrVr"
                            id="aumBrVr" required autofocus autocomplete="aumBrVr" class="max-sm:w-full"/>
                        <x-input-error for="aumBrVr"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Venta durante la descarga') }}" for="ventDurDesc" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="ventDurDesc" type="number" name="ventDurDesc"
                            id="ventDurDesc" required autofocus autocomplete="ventDurDesc" class="max-sm:w-full"/>
                        <x-input-error for="ventDurDesc"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Litros adicionales (cubetas)') }}" for="ltsAdc" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="ltsAdc" type="number" name="ltsAdc"
                            id="ltsAdc" required autofocus autocomplete="ltsAdc" class="max-sm:w-full"/>
                        <x-input-error for="ltsAdc"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Dif. de litros facturdos') }}" for="difLtsFact" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="difLtsFact" type="number" name="difLtsFact"
                            id="difLtsFact" required autofocus autocomplete="difLtsFact" class="max-sm:w-full"/>
                        <x-input-error for="difLtsFact"></x-input-error>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h2 class="flex gap-2 justify-center items-center border-b py-1"><x-icons.pc/>Físico</h2>
                <div class="pt-2 flex flex-wrap justify-evenly items-center gap-3">
                    <div>
                        <x-label value="{{ __('Diferencia física') }}" for="difFis" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="difFis" type="number" name="difFis"
                            id="difFis" required autofocus autocomplete="difFis" class="max-sm:w-full"/>
                        <x-input-error for="difFis"></x-input-error>
                    </div>
                    <div>
                        <x-label value="{{ __('Diferencia de litros entregados') }}" for="difLtsEnt" class="before:content-['*'] before:text-red-500"/>
                        <x-input wire:model.defer="difLtsEnt" type="number" name="difLtsEnt"
                            id="difLtsEnt" required autofocus autocomplete="difLtsEnt" class="max-sm:w-full"/>
                        <x-input-error for="difLtsEnt"></x-input-error>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <br>
    <div class="p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <fieldset class="border dark:border-gray-500 p-2 rounded-md">
            <legend class="text-xl px-2 bg-dark-eval-0 text-gray-200 rounded-md">Observaciones</legend>
            <div class="flex flex-wrap gap-4 justify-evenly items-center">
                <div>
                    <x-label value="{{ __('Estado físico y limpeza de pipa') }}" for="pipaStatus" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="pipaStatus" type="text" name="pipaStatus"
                        id="pipaStatus" required autofocus autocomplete="pipaStatus" class="max-sm:w-full"/>
                    <x-input-error for="pipaStatus"></x-input-error>
                </div>
                <div>
                    <x-label value="{{ __('Imagen de operador') }}" for="imgOp" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="imgOp" type="text" name="imgOp"
                        id="imgOp" required autofocus autocomplete="imgOp" class="max-sm:w-full"/>
                    <x-input-error for="imgOp"></x-input-error>
                </div>
            </div>
            <div>
                <x-label value="{{ __('Observaciones adicionales') }}" for="observaciones"/>
                <textarea wire:model.defer="observaciones" name="observaciones" id="observaciones" rows="5" class="w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white resize-none">
                </textarea>
                <x-input-error for="observaciones"></x-input-error>
            </div>
        </fieldset>
    </div>
    <div class="mt-3 flex flex-wrap justify-center gap-4">
        <x-button variant="success" wire:loading.attr='disabled' wire:click="updateRecepcion">
            <div class="flex justify-center items-center gap-2" wire:loading.remove>
                <x-icons.circle-check/>
                <span>Confirmar recepción</span>
            </div>
            <div wire:loading wire:target='updateRecepcion'>
                <x-icons.spin/>
                Aplicando cambios...
            </div>
        </x-button>
    </div>
</div>