<x-app-layout>
    @section('title', 'Dashboard')
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <x-card-greet>
                {{ $greeting }}
            </x-card-greet>

            {{-- @if ($valid->pivot->wr == 1)
                @livewire('dashboard.generate-reporte')
            @endif --}}
        </div>
    </x-slot>
    <div class="flex flex-wrap justify-center items-center gap-3 py-3">
        <div class="p-2 w-full">
            <div class="w-full">
                {{--  --}}
            </div>
        </div>
</x-app-layout>
