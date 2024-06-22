<div>
    <div class="flex flex-wrap gap-3 ">
        <div>
            <x-label value="{{ __('Total de litros') }}" for="lts" class="before:content-['*'] before:text-red-500"/>
            <x-input wire:model.defer="lts" type="number" name="lts"
                id="lts" required autofocus autocomplete="lts" class="max-sm:w-full"/>
            <x-input-error for="lts"></x-input-error>
        </div>
        <div>
            <x-label value="{{ __('Total de pesos') }}" for="total" class="before:content-['*'] before:text-red-500"/>
            <x-input wire:model.defer="total" type="number" name="total"
                id="total" required autofocus autocomplete="total" class="max-sm:w-full"/>
            <x-input-error for="total"></x-input-error>
        </div>
    </div>
    @foreach ($data as $key=> $detalle)
        @php
            $classes='';
            $border='';
            switch ($detalle['combustible']) {
                case 'MAGNA':
                    $clases='bg-green-700 text-green-100';
                    $border='border-green-300 dark:border-green-500';
                    break;
                case 'PREMIUM':
                    $clases='bg-red-700 text-red-100';
                    $border='border-red-300 dark:border-red-500';
                    break;
                default:
                    $clases='bg-black text-gray-100';
                    $border='border-gray-300 dark:border-gray-500';
                    break;
            }
        @endphp
    <fieldset wire:key='detalle{{$detalle['id']}}' class="border rounded-lg mt-3 px-2 py-3 {{$border}}">
        <legend class="px-2 py-1  rounded-lg {{$clases}}">{{$detalle['combustible']}} - TANQUE {{number_format($detalle['capacity'],2)}}lts</legend>
        <div>
            <div class="flex flex-wrap gap-3 ">
                <div>
                    <x-label value="{{ __('VeederRoot') }}" for="data.{{$key}}.v" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="data.{{$key}}.v" type="number" name="data.{{$key}}.v"
                        id="data.{{$key}}.v" required autofocus autocomplete="data.{{$key}}.v" class="max-sm:w-full"/>
                    <x-input-error for="data.{{$key}}.v"></x-input-error>
                </div>
                <div>
                    <x-label value="{{ __('Físico') }}" for="data.{{$key}}.f" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="data.{{$key}}.f" type="number" name="data.{{$key}}.f"
                        id="data.{{$key}}.f" required autofocus autocomplete="data.{{$key}}.f" class="max-sm:w-full"/>
                    <x-input-error for="data.{{$key}}.f"></x-input-error>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 mt-3">
                <div>
                    <x-label value="{{ __('Venta periféricos') }}" for="data.{{$key}}.vp" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="data.{{$key}}.vp" type="number" name="data.{{$key}}.vp"
                        id="data.{{$key}}.vp" required autofocus autocomplete="data.{{$key}}.vp" class="max-sm:w-full"/>
                    <x-input-error for="data.{{$key}}.vp"></x-input-error>
                </div>
                <div>
                    <x-label value="{{ __('Venta electrónica') }}" for="data.{{$key}}.ve" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="data.{{$key}}.ve" type="number" name="data.{{$key}}.ve"
                        id="data.{{$key}}.ve" required autofocus autocomplete="data.{{$key}}.ve" class="max-sm:w-full"/>
                    <x-input-error for="data.{{$key}}.ve"></x-input-error>
                </div>
                <div>
                    <x-label value="{{ __('Venta odómetro') }}" for="data.{{$key}}.vo" class="before:content-['*'] before:text-red-500"/>
                    <x-input wire:model.defer="data.{{$key}}.vo" type="number" name="data.{{$key}}.vo"
                        id="data.{{$key}}.vo" required autofocus autocomplete="data.{{$key}}.vo" class="max-sm:w-full"/>
                    <x-input-error for="data.{{$key}}.vo"></x-input-error>
                </div>
            </div>
        </div>
    </fieldset>
        {{-- <x-input wire:model="data.{{$key}}.v"/>
        <p>{{$data[$key]['v']}}</p> --}}
    @endforeach
    <div class="mt-3 flex flex-wrap justify-center gap-4">
        <x-button variant="info" wire:loading.attr='disabled' wire:click="updateLectura">
            <div class="flex justify-center items-center gap-2" wire:loading.remove>
                <x-icons.circle-check/>
                <span>Confirmar edición</span>
            </div>
            <div wire:loading wire:target='updateLectura'>
                <x-icons.spin/>
                Aplicando cambios...
            </div>
        </x-button>
    </div>
</div>
