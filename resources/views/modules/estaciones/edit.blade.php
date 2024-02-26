<x-app-layout>
    @section('title', 'Editar Estación')
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <x-card-greet-header>
                {{ __('EDITAR ESTACIÓN')}}
            </x-card-greet-header>
        </div>
    </x-slot>
    @livewire('estacion.estacion-edit',['estacionID'=>$estacionID])
</x-app-layout>