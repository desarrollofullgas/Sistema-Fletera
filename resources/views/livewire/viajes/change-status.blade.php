<div class="text-gray-400 hover:text-indigo-500">
    @if ($status=='En tránsito')
        <button type="button" title="Inicio de descarga" wire:click='descarga'>
            <x-icons.descarga-fuel/>
        </button>
    @else
        <button type="button" title="Finalizar viaje" wire:click='end'>
            <x-icons.check/>
        </button>
    @endif
</div>
