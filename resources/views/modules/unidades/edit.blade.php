<x-app-layout>
    @section('title', 'Modificar unidad')
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <x-card-greet-header>
                {{ __('UNIDAD #').$unidadID }}
            </x-card-greet-header>
        </div>
    </x-slot>
    @livewire('unidades.edit-unidad',['unidadID'=>$unidadID])
</x-app-layout>