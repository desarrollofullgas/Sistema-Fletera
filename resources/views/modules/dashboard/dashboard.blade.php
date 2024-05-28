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
    <div class="flex flex-wrap justify-center items-center gap-3 my-3">
        <div class="border rounded-md bg-white dark:bg-dark-eval-1 dark:border-0 shadow-sm w-full">
            @livewire('dashboard.graphics.viajes-resumen')
        </div>
        <div class="flex flex-wrap justify-center gap-3">
            <div class="border rounded-md bg-white dark:bg-dark-eval-1 dark:border-0 shadow-sm flex items-center">
                @livewire('dashboard.graphics.unidades-status')
            </div>
            <div class="border rounded-md bg-white dark:bg-dark-eval-1 dark:border-0 shadow-sm">
                @livewire('dashboard.graphics.compras-estacion')
            </div>
        </div>
    </div>
        {{-- scripts de Echarts --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.0/dist/echarts.min.js"></script>
    @endpush
</x-app-layout>
