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
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-label class="mb-1">Nombre</x-label>
                    <x-input class="w-ful" placeholder="Por ejemplo: Tamaño, Color"></x-input>
                </div>
                <div>
                    <x-label class="mb-1">Tipo</x-label>
                    <x-select class="w-full">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>
            </div>
            <div class="flex items-center mb-4">
                <hr class="flex-1"><span class="mx-4">Valores</span> <hr class="flex-1">
            </div>
            <div class="p-6 rounded-lg border border-gray-200">
                <div class="grid grid-col-2 gap-6">
                    <div>
                        <x-label class="mb-1">Valor</x-label>
                        <x-input class="w-ful" placeholder="Ingrese el valor de la opcion"></x-input>
                    </div>
                    <div>
                        <x-label class="mb-1">Descripcion</x-label>
                        <x-input class="w-ful" placeholder="Ingrese una descripcion"></x-input>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
