<div>
    <section class="rounded-lg bg-white shadow-lg">
        <header class="border-b px-6 py-2 border-gray-200">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">Opciones</h1>
                <x-button wire:click="$set('openModal',true)">Nuevo</x-button>
            </div>
        </header>
        <div class="p-6">
            <div class="space-y-6">
                @foreach ($options as $option)
                    <div class="p-6 rounded-lg border border-gray-200 relative">
                        <div class="absolute bg-white -top-3 px-4"><span>{{ $option->name }}</span></div>
                    </div>
                    {{-- Valores  --}}
                    <div class="flex flex-wrap">
                        @foreach ($option->features as $feature)
                            @switch($option->type)
                                @case(1)
                                    {{-- Texto --}}
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">{{ $feature->description }}</span>
                                @break

                                @case(2)
                                    {{-- Color --}}
                                    <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4"
                                        style="background-color:{{ $feature->value }}"></span>
                                @break

                                @case(3)
                                    {{-- Sexo --}}
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">{{ $feature->description }}</span>
                                @break

                                @default
                            @endswitch
                        @endforeach
                    </div>
                @endforeach
            </div>

        </div>

    </section>
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title"></x-slot>
        <x-slot name="content">
            <x-validation-errors class="mb-4"></x-validation-errors>
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-label class="mb-1">Nombre</x-label>
                    <x-input wire:model="newOption.name" class="w-full"
                        placeholder="Por ejemplo: Tamaño, Color"></x-input>
                </div>
                <div>
                    <x-label class="mb-1">Tipo</x-label>
                    <x-select wire:model.live="newOption.type" class="w-full">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>
            </div>
            <div class="flex items-center mb-4">
                <hr class="flex-1"><span class="mx-4">Valores</span>
                <hr class="flex-1">
            </div>
            <div class="mb-4 space-y-4">
                @foreach ($newOption->features as $index => $feature)
                    <div class="p-6 rounded-lg border border-gray-200 relative">
                        <div class="grid grid-cols-2 gap-6" wire:key="features-{{ $index }}">
                            <div class="absolute -top-3 px-4 bg-white border rounded-lg">
                                <button wire:click="removeFeature({{ $index }})"><i
                                        class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i></button>
                            </div>
                            <div>
                                <x-label class="mb-1">Valor</x-label>

                                @switch($newOption->type)
                                    @case(1)
                                    {{-- Texto  --}}
                                        <x-input wire:model="newOption.features.{{ $index }}.value" class="w-full"
                                            placeholder="Ingrese el valor de la opcion"></x-input>
                                    @break
                                       
                                    @case(2)
                                    {{-- Color  --}}
                                    <div class="border border-gray-300 rounded-md h-[42px] flex item-center justify-between px-3">
                                        {{$newOption['features'][$index]['value']?: 'Seleccione un color'}}
                                        <input wire:model.live="newOption.features.{{ $index }}.value" type="color" >
                                    </div>
                                     
                                    @break

                                    @default
                                @endswitch
                            </div>
                            <div>
                                <x-label class="mb-1">Descripcion</x-label>
                                <x-input wire:model="newOption.features.{{ $index }}.description" class="w-full"
                                    placeholder="Ingrese una descripcion"></x-input>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end">
                <x-button wire:click="addFeature">Agregar valor</x-button>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="addOption" class="btn btn-blue">Agregar</button>
        </x-slot>
    </x-dialog-modal>
</div>
