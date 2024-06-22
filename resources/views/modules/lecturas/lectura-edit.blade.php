<x-app-layout>
    @section('title', 'Editar Lectura')
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <x-card-greet-header>
                {{ __('Lectura #'.$val) }}
            </x-card-greet-header>
        </div>
    </x-slot>
    <div class="p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @livewire('lecturas.edit-lectura',['lecturaID'=>$val])
    </div>
    <br>
</x-app-layout>