<div>
    <section class="bg-white rounded-lg shadow overflow-hidden">
        <header class="bg-gray-900 px-4 py-2">
            <h2 class="text-white text-lg">Direcciones de envío guardadas</h2>
        </header>

        <div class="p-4">
            @if ($newAddresses)
                <x-validation-errors class="mb-6"></x-validation-errors>
                <div class="grid grid-cols-4 gap-4">
                    {{-- Type --}}
                    <div class="col-span-1">
                        <x-select wire:model="createAddress.type">
                            <option value="">Tipo de dirección</option>
                            <option value="1">Domicilio</option>
                            <option value="2">Oficina</option>
                        </x-select>
                    </div>

                    {{-- Description --}}
                    <div class="col-span-3">
                        <x-input wire:model="createAddress.description" class="w-full" type="text"
                            placeholder="Nombre de la dirección" />
                    </div>

                    {{-- District --}}
                    <div class="col-span-2">
                        <x-input wire:model="createAddress.district" class="w-full" type="text"
                            placeholder="Distrito" />
                    </div>

                    {{-- Reference --}}
                    <div class="col-span-2">
                        <x-input wire:model="createAddress.reference" class="w-full" type="text"
                            placeholder="Referencia" />
                    </div>
                </div>

                <hr class="my-4">

                <div x-data="{
                    receiver: @entangle('createAddress.receiver'),
                    receiver_info: @entangle('createAddress.receiver_info')
                }" x-init="$watch('receiver', value => {
                    if (value == 1) {
                        receiver_info.name = '{{ auth()->user()->name }}';
                        receiver_info.last_name = '{{ auth()->user()->last_name }}';
                        receiver_info.document_type = '{{ auth()->user()->document_type }}';
                        receiver_info.document_number = '{{ auth()->user()->document_number }}';
                        receiver_info.phone = '{{ auth()->user()->phone }}';
                    } else {
                        receiver_info.name = '';
                        receiver_info.last_name = '';
                        receiver_info.document_number = '';
                        receiver_info.phone = '';
                    }
                })">
                    <p class="font-semibold mb-4">¿Quién recibirá el pedido?</p>
                    <div class="flex space-x-2">
                        <label class="flex items-center">
                            <input x-model="receiver" type="radio" value="1" class="mr-1"> Seré yo
                        </label>
                        <label class="flex items-center">
                            <input x-model="receiver" type="radio" value="2" class="mr-1"> Otra persona
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <div><x-input x-bind:disabled="receiver == 1" x-model="receiver_info.name" class="w-full"
                                placeholder="Nombres" /></div>
                        <div><x-input x-bind:disabled="receiver == 1" x-model="receiver_info.last_name" class="w-full"
                                placeholder="Apellidos" /></div>

                        <div>
                            <div class="flex space-x-2">
                                <x-select x-bind:disabled="receiver == 1" x-model="receiver_info.document_type">
                                    @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                        <option value="{{ $item->value }}">{{ $item->name }}</option>
                                    @endforeach
                                </x-select>
                                <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.document_number"
                                    type="text" placeholder="Número de documento" class="w-full" />
                            </div>
                        </div>

                        <div>
                            <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.phone" type="text"
                                placeholder="Número de teléfono" class="w-full" />
                        </div>

                        <div>
                            <button wire:click="$set('newAddresses', false)"
                                class="btn btn-outline-gray w-full">Cancelar</button>
                        </div>
                        <div>
                            <button wire:click="store" class="btn btn-blue w-full">Guardar</button>
                        </div>
                    </div>
                </div>
            @else
                @if ($editAddress->id)
                    <x-validation-errors class="mb-6"></x-validation-errors>
                    <div class="grid grid-cols-4 gap-4">
                        {{-- Type --}}
                        <div class="col-span-1">
                            <x-select wire:model="editAddress.type">
                                <option value="">Tipo de dirección</option>
                                <option value="1">Domicilio</option>
                                <option value="2">Oficina</option>
                            </x-select>
                        </div>

                        {{-- Description --}}
                        <div class="col-span-3">
                            <x-input wire:model="editAddress.description" class="w-full" type="text"
                                placeholder="Nombre de la dirección" />
                        </div>

                        {{-- District --}}
                        <div class="col-span-2">
                            <x-input wire:model="editAddress.district" class="w-full" type="text"
                                placeholder="Distrito" />
                        </div>

                        {{-- Reference --}}
                        <div class="col-span-2">
                            <x-input wire:model="editAddress.reference" class="w-full" type="text"
                                placeholder="Referencia" />
                        </div>
                    </div>

                    <hr class="my-4">

                    <div x-data="{
                        receiver: @entangle('editAddress.receiver'),
                        receiver_info: @entangle('editAddress.receiver_info')
                    }" x-init="$watch('receiver', value => {
                        if (value == 1) {
                            receiver_info.name = '{{ auth()->user()->name }}';
                            receiver_info.last_name = '{{ auth()->user()->last_name }}';
                            receiver_info.document_type = '{{ auth()->user()->document_type }}';
                            receiver_info.document_number = '{{ auth()->user()->document_number }}';
                            receiver_info.phone = '{{ auth()->user()->phone }}';
                        } else {
                            receiver_info.name = '';
                            receiver_info.last_name = '';
                            receiver_info.document_number = '';
                            receiver_info.phone = '';
                        }
                    })">
                        <p class="font-semibold mb-4">¿Quién recibirá el pedido?</p>
                        <div class="flex space-x-2">
                            <label class="flex items-center">
                                <input x-model="receiver" type="radio" value="1" class="mr-1"> Seré yo
                            </label>
                            <label class="flex items-center">
                                <input x-model="receiver" type="radio" value="2" class="mr-1"> Otra persona
                            </label>
                        </div>

                        <div class="grid grid-cols-2 gap-2 mt-2">
                            <div><x-input x-bind:disabled="receiver == 1" x-model="receiver_info.name" class="w-full"
                                    placeholder="Nombres" /></div>
                            <div><x-input x-bind:disabled="receiver == 1" x-model="receiver_info.last_name"
                                    class="w-full" placeholder="Apellidos" /></div>

                            <div>
                                <div class="flex space-x-2">
                                    <x-select x-bind:disabled="receiver == 1" x-model="receiver_info.document_type">
                                        @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                            <option value="{{ $item->value }}">{{ $item->name }}</option>
                                        @endforeach
                                    </x-select>
                                    <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.document_number"
                                        type="text" placeholder="Número de documento" class="w-full" />
                                </div>
                            </div>

                            <div>
                                <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.phone" type="text"
                                    placeholder="Número de teléfono" class="w-full" />
                            </div>

                            <div>
                                <button wire:click="$set('editAddresses.id', null)"
                                    class="btn btn-outline-gray w-full">Cancelar</button>
                            </div>
                            <div>
                                <button wire:click="uodate()" class="btn btn-blue w-full">Actualizar</button>
                            </div>
                        </div>
                    </div>
                @else
                    @if ($addresses->count())
                        <ul class="grid grid-cols-3 gap-4">
                            @foreach ($addresses as $address)
                                <li class="{{ $address->default ? 'bg-blue-200' : 'bg-white' }} rounded-lg shadow"
                                    wire:key="addresses-{{$address->id}}">
                                    <div class="p-4 flex items-center">
                                        <div><i class="fa-solid fa-house text-xl text-blue-600"></i></div>
                                        <div class="flex-1 mx-4 text-xs">
                                            <p class="text-blue-600">{{ $address->type == 1 ? 'Domicilio' : 'Oficina' }}</p>
                                            <p class="text-gray-600 font-semibold">{{ $address->district }}</p>
                                            <p class="text-gray-600 font-semibold">{{ $address->description }}</p>
                                            <p class="text-gray-600 font-semibold">
                                                {{ $address->receiver_info['name'] }}</p>
                                        </div>
                                        <div class="text-xs text-gray-800 flex flex-col">
                                            <button wire:click="setDefaultAddress({{ $address->id }})"><i
                                                    class="fa-solid fa-star"></i></button>
                                            <button wire:click="edit({{ $address->id }})"><i
                                                    class="fa-solid fa-pencil"></i></button>
                                            <button wire:click="deleteAddress({{ $address->id }})"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center">No se han encontrado direcciones</p>
                    @endif
                @endif
            @endif

            <button wire:click="$set('newAddresses', true)"
                class="btn btn-outline-gray w-full items-center justify-center mt-4">
                Agregar <i class="fa-solid fa-plus ml-2"></i>
            </button>
        </div>
    </section>
</div>
