<div class="mt-2">
    <section class="rounded-lg border border-gray-100 bg-white shadow-lg">
        <header class="border-b px-6 py-2 border-gray-200">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">Opciones</h1>
                <x-button wire:click="$set('openModal',true)">Nuevo</x-button>
            </div>
        </header>
        <div class="p-6">
            <div class="space-y-6">
                @foreach ($product->options as $option)
                    <div wire:key="product-option-{{ $option->id }}"
                        class="p-6 rounded-lg border border-gray-200 relative">
                        <div class="absolute -top-3 px-4 bg-white"><button>
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i></button>
                        </div>
                        <span class="ml-2">
                            {{ $option->name }}
                        </span>
                        {{-- Valores  --}}
                        <div class="flex flex-wrap">
                            @foreach ($option->pivot->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        {{-- Texto --}}
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">{{ $feature['description'] }}
                                            <button class=" ml-0.5" onclick="confirmDeleteFeature({{$option->id, $feature['id'] }},'feature')">
                                                <li class="fa-solid fa-xmark hover:text-red-500"></li>
                                            </button>
                                        </span>
                                    @break

                                    @case(2)
                                        {{-- Color --}}
                                        <div class="relative">
                                            <span
                                                class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-2"
                                                style="background-color:{{ $feature['value'] }}">
                                            </span>
                                            <button onclick="confirmDelete({{ $feature['id'] }})"
                                                class="absolute z-10 left-3 -top-2 rounded-full bg-red-500 hover:bg-red-700 h-4 w-4 flex justify-center items-center">
                                                <li class="fa-solid fa-xmark text-white text-xs"></li>
                                            </button>
                                        </div>
                                    @break

                                    @case(3)
                                        {{-- Sexo --}}
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">{{ $feature->description }}
                                            <button>
                                                <li class="fa-solid fa-xmark hover:text-red-500"></li>
                                            </button> </span>
                                    @break

                                    @default
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">Agregar nueva opcion</x-slot>
        <x-slot name="content">
            <x-validation-errors class="mb-4"></x-validation-errors>
            <div class="mb-4">
                <x-label class="mb-1">Opcion</x-label>
                <x-select class="w-full" wire:model.live="variant.option_id">
                    <option value="" disabled>Seleccione una opcion</option>
                    @foreach ($options as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="flex items-center mb-6">
                <hr class="flex-1"><span class="mx-4">Valores</span>
                <hr class="flex-1">
            </div>
            <ul class="mb-4 space-y-4">
                @foreach ($variant['features'] as $index => $feature)
                    <li wire:key="variant-feature-{{ $index }}"
                        class="relative border border-gray-200 rounded-lg p-6">
                        <div class="absolute -top-3 bg-white px-4 border rounded-lg">
                            <button wire:click="removeFeature({{ $index }})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i>
                            </button>
                        </div>
                        <div>
                            <x-label class="mb-1">Valores</x-label>
                            <x-select class="w-full" wire:model="variant.features.{{ $index }}.id"
                                wire:change="feature_change({{ $index }})">
                                <option value="" disabled>Seleccione un valor</option>
                                @foreach ($this->features as $feature)
                                    <option value="{{ $feature->id }}">{{ $feature->description }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="flex justify-end">
                <x-button wire:click="addFeature">Agregar valor</x-button>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$set('openModal',false)">Cancelar</x-danger-button>
            <x-button class="ml-2" wire:click="save">Guardar</x-button>
        </x-slot>
    </x-dialog-modal>
    @push('js')
        <script>
            function confirmDeleteFeature(option_id, feature_id) {
                Swal.fire({
                    title: "Seguro Eliminar Valores?",
                    text: "Este Proceso es Inrebersible!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, Eliminar!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {

                        @this.call('deleteFeature', option_id, feature_id);


                    }
                });

            }

            function confirmDeleteOption(option_id) {
                Swal.fire({
                    title: "Seguro Eliminar La Option",
                    text: "Este Proceso es Inrebersible!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, Eliminar!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('deleteOption', option_id);
                    }
                });

            }
        </script>
    @endpush
</div>
