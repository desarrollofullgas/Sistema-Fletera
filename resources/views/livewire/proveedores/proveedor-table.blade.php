<div>
    <div class="py-4 space-y-4">
        {{-- Filtros --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            {{-- Barra de Busqueda --}}
            <div>
                <x-input wire:model="search" type="text" class="w-auto" placeholder="Buscar proveedores..." />
            </div>
            {{-- Acciones Masivas --}}
            @if ($checked)
                <x-dropdown align="right" width="60">
                    <x-slot name="trigger">
                        <button type="button"
                            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                            Seleccionados
                            <span
                                class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">
                                {{ count($checked) }}
                            </span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="w-60">
                            <!-- Encabezado -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Opciones') }}
                            </div>
                            <!-- Eliminar y Exportar-->
                            <div>
                                @if ($valid->pivot->de == 1)
                                    <x-dropdown-link href="#" wire:click="deleteProveedores">
                                        {{ __('Eliminar Proveedor') }}
                                    </x-dropdown-link>
                                @endif
                                <x-dropdown-link href="#" wire:click="exportSelected">
                                    {{ __('Exportar a Excel') }}
                                </x-dropdown-link>
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            @endif
            {{-- Filtro de Fechas --}}
            <div class="flex items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input type="date" name="start" id="from_date" wire:model="from_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <span class="mx-4 text-gray-500">a</span>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input type="date" name="end" id="to_date" wire:model="to_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <button wire:click="clearDateFilters" class="mx-4 text-gray-500">x</button>
            </div>
        </div>
        @if ($selectPage)
            @if ($selectAll)
                <div class="text-gray-400 text-xs">
                    Se han seleccionado <strong>{{ $proveedores->total() }}</strong> elementos.
                </div>
            @else
                <div class="text-gray-400 text-xs">
                    Se han seleccionado <strong>{{ count($checked) }}</strong> elementos, ¿Deseas seleccionar los
                    <strong>{{ $proveedores->total() }}</strong>?
                    <a href="#" class="text-blue-500 hover:underline" wire:click="selectAll">Seleccionar todo</a>
                </div>
            @endif
        @endif

        {{-- Modal para mostrar zonas --}}
        <x-dialog-modal wire:model="showingAllZonas" class="flex items-center">
            <x-slot name="title">
                <div class="bg-dark-eval-1 dark:bg-gray-600 p-1 rounded-md text-white text-center">
                    {{ __('ZONAS PROVEEDOR') }} 
                </div>
            </x-slot>

            <x-slot name="content">
                <!-- Mostrar todas las zonas -->
                <ul class="text-center">
                    @foreach ($allZonas as $zona)
                        <li>{{ $zona->name }}</li>
                    @endforeach
                </ul>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('showingAllZonas', false)">
                    Cerrar
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>

        <div class="flex-col space-y-4">
            {{-- Componente tabla --}}
            <x-table>
                <x-slot name="head">
                    {{-- Componente Heading  --}}
                    <x-heading><x-input type="checkbox" wire:model="selectPage" /></x-heading>
                    <x-heading sortable wire:click="sortBy('id')" :direction="$sortField === 'id' ? $sortDirection : null">ID</x-heading>
                    <x-heading sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null">PROVEEDOR</x-heading>
                    <x-heading sortable wire:click="sortBy('status')" :direction="$sortField === 'status' ? $sortDirection : null">ESTADO</x-heading>
                    <x-heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">ZONA</x-heading>
                    <x-heading>OPCIONES</x-heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($proveedores as $pro)
                        {{-- Componente Row --}}
                        <x-row wire:loading.class.delay="opacity-75">
                            {{-- Componente Column --}}
                            <x-cell> <x-input type="checkbox" value="{{ $pro->id }}" wire:model="checked" />
                            </x-cell>
                            <x-cell>{{ $pro->id }} </x-cell>
                            <x-cell><span class="font-bold">{{ $pro->name }}</span></x-cell>
                            <x-cell>
                                <span class="rounded bg-gray-200 py-1 px-3 text-xs text-gray-500 font-bold">
                                    {{ $pro->status }}
                                </span>
                            </x-cell>
                            <x-cell>
                                <div class="flex flex-wrap">
                                    @if ($pro->zonas->isEmpty())
                                        <div>Por Definir</div>
                                    @else
                                        @php $maxZonasToShow = 1; @endphp
                                        @foreach ($pro->zonas->take($maxZonasToShow) as $zona)
                                            {{ $zona->name }}
                                        @endforeach
                                        @if ($pro->zonas->count() > $maxZonasToShow)
                                            <button class="ml-1 text-blue-600 dark:text-gray-400 hover:underline text-xs font-bold"
                                                wire:click="getAllZonas({{ $pro->id }})">Ver más</button>
                                        @endif
                                    @endif
                                </div>
                            </x-cell>
                            <x-cell>
                                <div class="flex gap-2 justify-center items-center">
                                    <div>
                                        @if ($valid->pivot->vermas == 1)
                                            @livewire('proveedores.proveedor-show', ['proveedorID' => $pro->id], key('show' . $pro->id))
                                        @endif
                                    </div>
                                    <div>
                                        @if ($valid->pivot->ed == 1)
                                            @livewire('proveedores.proveedor-edit', ['prov_id' => $pro->id], key('ed' . $pro->id))
                                        @endif
                                    </div>
                                    <div>
                                        @if ($valid->pivot->de == 1)
                                            @livewire('proveedores.proveedor-delete', ['proveedorID' => $pro->id], key('del' . $pro->id))
                                        @endif
                                    </div>
                                </div>
                            </x-cell>
                        </x-row>
                    @empty
                        <x-row>
                            <x-cell colspan="8">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icons.inbox class="w-8 h-8 text-gray-300" />
                                    <span class="py-8 font-medium text-gray-400 text-xl">No se encontraron
                                        resultados...</span>
                                </div>
                            </x-cell>
                        </x-row>
                    @endforelse
                </x-slot>
            </x-table>
            {{-- Paginación y contenido por página --}}
            <div class="py-4 px-3">
                <div class="flex space-x-4 items-center mb3">
                    <x-label class="text-sm font-medium text-gray-600">Mostrar</x-label>
                    <select wire:model.live="perPage"
                        class="bg-gray-50 border border-gray-300 text-gray-400 text-sm rounded-lg focus:ring-indigo-500">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
                {{ $proveedores->links() }}
            </div>
        </div>
    </div>
</div>
