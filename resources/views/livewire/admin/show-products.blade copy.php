<div>
    <x-slot class="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuarios</h2>
    </x-slot>
    <div class="container py-12">
        <x-table-responsive>
            <div class="px-6 py-4">
                <x-jet-input type="text" wire:model="search" class="w-full" placeholder="Ingrese el nombre del producto que quiere buscar"/>
            </div>
            @if ($products->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="sr-only">Editar</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink h-10 w-10">
                                            @if($product->images->count())
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                                            @else
                                                <img class="h-10 w-10 rounded-full object-cover" src="https://via.placeholder.com/150" alt="">
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">
                                    {{ $product->subcategory->category->name }}
                                </div></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->price }} USD</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <!-- Aquí puedes agregar botones o enlaces para acciones como editar o eliminar -->
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-4">
                    {{ $products->links() }}
                </div>
            @else
                <div class="px-6 py-4">
                    No hay ningún registro coincidente
                </div>
            @endif
            @if ($products->hasPages())
                <div class="px-6 py-4">
                    {{$products->links()}}
                </div>
            @endif
        </x-table-responsive>
    </div>
</div>
