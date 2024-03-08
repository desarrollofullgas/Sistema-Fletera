<x-app-layout>
    @section('title', 'Lecturas')
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <x-card-greet-header>
                {{ __('LECTURAS') }}
            </x-card-greet-header>
            <div class=" flex justify-center space-x-2">
                <div>
                    @livewire('lecturas.new-lectura')
                </div>
                @if ($valid->pivot->verpap == 1)
                    <div>
                        <a class="inline-flex items-center px-3 py-2.5 text-sm font-medium text-center float-right text-white bg-gray-400 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-dark-eval-3 "
                            href="{{ route('lecturas.trashed') }}">
                            Eliminados
                            <span
                                class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-black bg-white rounded-full">
                                {{ $trashed }}
                            </span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </x-slot>
    @livewire('lecturas.lectura-table')
</x-app-layout>
