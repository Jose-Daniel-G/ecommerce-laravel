<div>
    <h1 class="text-xl text-gray-600 mb-2">
        {{ $product->name }}
    </h1>
    <div class="flex items-center space-x-2 mb-4">
        <ul class="flex space-x-1 text-sm">
            <li><i class="fa-solid fa-star text-yellow-400"></i></li>
            <li><i class="fa-solid fa-star text-yellow-400"></i></li>
            <li><i class="fa-solid fa-star text-yellow-400"></i></li>
            <li><i class="fa-solid fa-star text-yellow-400"></i></li>
            <li><i class="fa-solid fa-star text-yellow-400"></i></li>
        </ul>
        <p class="text-sm text-gray-600">4.7(55)</p>
    </div>
    <div class="flex justify-between items-center">
        <p class="font-semibold text-2-xl text-gray-600 mb-4">$/{{ $product->price }}</p>
        <p>Stock:{{ $stock }}</p>
    </div>
    <div class="flex items-center space-x-6 mb-6" x-data="{qty: @entangle('qty').live,stock: @entangle('stock').live,}">
        <!-- Botón restar -->
        <button class="btn btn-gray" x-on:click="qty=qty-1" x-bind:disabled="qty <= 1">-</button>

        <!-- Mostrar cantidad -->
        <span x-text="qty" class="inline-block w-6 text-center"></span>

        <!-- Botón sumar -->
        <button class="btn btn-gray" x-on:click="qty=qty+1" x-bind:disabled="qty >= stock">+</button>
    </div>

    <div class="flex flex-wrap">
        @foreach ($product->options as $option)
            <div class="mr-4 mb-4">
                <p class="font-semibold text-lg mb-2">{{ $option->name }}</p>
                <ul class="flex items-center space-x-4">
                    @foreach ($option->pivot->features as $feature)
                        <li>
                            @switch($option->type)
                                @case(1)
                                    <button
                                        class="w-20 h-8 font-semibold uppercase text-sm rounded-lg {{ $selectedFeatures[$option->id] == $feature['id'] ? 'bg-blue-600 text-white' : '' }}"
                                        wire:click="$set('selectedFeatures.{{ $option->id }}',{{ $feature['id'] }})">
                                        {{ $feature['value'] }}
                                    </button>
                                @break

                                @case(2)
                                    {{-- Color  --}}
                                    <div
                                        class="p-0.5 border-2 rounded-lg flex items-center -mt-1.5 {{ $selectedFeatures[$option->id] == $feature['id'] ? 'border-blue-600' : 'border-transparent' }}">
                                        <button class="w-20 h-8 rounded-lg border border-gray-200"
                                            wire:click="$set('selectedFeatures.{{ $option->id }}',{{ $feature['id'] }})"
                                            style="background-color:{{ $feature['value'] }}">
                                        </button>
                                    </div>
                                @break

                                @default
                            @endswitch

                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
    {{-- @dump($selectedFeatures) --}}
    <button class="btn btn-blue w-full mb-6" wire:click="add_to_cart" wire:loading.attr="disabled">Agregar al
        carrito</button>
    <div class="text-sm mb-4">{{ $product->description }}</div>

    <div class="text-gray-700 flex items-center space-x-4">
        <i class="fa-solid fa-truck-fast text-2xl">
            <p>Despacho a domicilio</p>
        </i>
    </div>

</div>
