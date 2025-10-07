<div>
    <form wire:submit="addFeature" class="flex space-x-4">

        <div class="flex-1">
            <x-label class="mb-1">Valor</x-label>

            @switch($option->type)
                @case(1)
                    {{-- Texto  --}}
                    <x-input wire:model="newFeature.value" class="w-full" placeholder="Ingrese el valor de la opcion"></x-input>
                @break

                @case(2)
                    {{-- Color  --}}
                    <div class="border border-gray-300 rounded-md h-[42px] flex item-center justify-between px-3">
                        {{ $newFeature['value'] ?: 'Seleccione un color' }}
                        <input wire:model.live="newFeature.value" type="color">
                    </div>
                @break

                @default
            @endswitch
        </div>
        <div class="flex-1">
            <x-label class="mb-1">Descripcion</x-label>
            <x-input wire:model="newFeature.description" class="w-full" placeholder="Ingrese una descripcion"></x-input>
        </div>
        <div class="pt-7">
            <x-button>Agregar</x-button>
        </div>
    </form>
</div>
