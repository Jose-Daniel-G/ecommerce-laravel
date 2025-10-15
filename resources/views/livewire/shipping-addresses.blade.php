<div>
    <section class="bg-white rounded-lg shadow">
        <header class="bg-gray-900 px-4 py-2">
            <h1 class="text-white text-lg">Direcciones de envío guardadas</h1>
        </header>

        <div class="p-4">
            @if ($newAddress)
                <div class="grid grid-cols-4 gap-4">
                    {{-- Type --}}
                    <div class="col-span-1">
                        <x-select wire:model="createdAddress.type">
                            <option value="">Tipo de dirección</option>
                            <option value="1">Domicilio</option>
                            <option value="2">Oficina</option>
                        </x-select>
                    </div>

                    {{-- Description --}}
                    <div class="col-span-3">
                        <x-input wire:model="createdAddress.description" class="w-full" type="text"
                            placeholder="Nombre de la dirección" />
                    </div>

                    {{-- District --}}
                    <div class="col-span-2">
                        <x-input wire:model="createdAddress.district" class="w-full" type="text"
                            placeholder="Distrito" />
                    </div>

                    {{-- Reference --}}
                    <div class="col-span-2">
                        <x-input wire:model="createdAddress.reference" class="w-full" type="text"
                            placeholder="Referencia" />
                    </div>
                </div>

                <hr class="my-4">

                <div>
                    <p class="font-semibold mb-4">¿Quién recibirá el pedido?</p>
                    <div class="flex space-x-2">
                        <label class="flex items-center">
                            <input type="radio" value="1" class="mr-1"> Seré yo
                        </label>
                        <label class="flex items-center">
                            <input type="radio" value="2" class="mr-1"> Otra persona
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <div><x-input class="w-full" placeholder="Nombres" /></div>
                        <div><x-input class="w-full" placeholder="Apellidos" /></div>

                        <div>
                            <div class="flex space-x-2">
                                <x-select>
                                    @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                        <option value="{{ $item->value }}">{{ $item->name }}</option>
                                    @endforeach
                                </x-select>
                                <x-input type="text" placeholder="Número de documento" class="w-full" />
                            </div>
                        </div>

                        <div>
                            <x-input type="text" placeholder="Número de teléfono" class="w-full" />
                        </div>

                        <div>
                            <button class="btn btn-outline-gray w-full">Cancelar</button>
                        </div>
                        <div>
                            <button class="btn btn-outline-blue w-full">Guardar</button>
                        </div>
                    </div>
                </div>
            @else
                @if ($addresses->count())
                    {{-- Aquí podrías mostrar la lista de direcciones --}}
                @else
                    <p class="text-center">No se han encontrado direcciones</p>
                @endif
            @endif

            <button wire:click="$set('newAddress', true)"
                class="btn btn-outline-gray w-full items-center justify-center mt-4">
                Agregar <i class="fa-solid fa-plus ml-2"></i>
            </button>
        </div>
    </section>
</div>
