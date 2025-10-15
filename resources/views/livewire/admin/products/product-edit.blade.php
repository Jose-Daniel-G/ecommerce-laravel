<div>
    <form wire:submit="store">
        <figure class="mb-4 relative">
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700"><i
                        class="fas fa-camera mr-2"></i>Actualizar Imagen
                    <input type="file" class="hidden" wire:model="image" accept="image/*">
                </label>
            </div>
            {{-- ORIGINAL DEL CURSO --}}
            {{-- <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $image ? $image->temporaryUrl() : $productEdit['image_path'] }}" alt=""> --}}
            <img src="{{ $product->image }}" class="w-full h-48 object-cover object-center" alt="">

        </figure>
        <x-validation-errors class="mb-4"></x-validation-errors>
        <div class="card">
            <div class="mb-4">
                <x-label class="mb-1">Codigo (SKU)</x-label>
                <x-input wire:model="productEdit.sku" class="w-full"  
                    placeholder="Por favor ingrese el codigo del producto"></x-input>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Nombre</x-label>
                <x-input wire:model="productEdit.name" class="w-full"
                    placeholder="Por favor ingrese el nombre del producto"></x-input>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Descripcion</x-label>
                <x-textarea wire:model="productEdit.description" class="w-full"
                    placeholder="Por favor ingrese las descripcion del producto"></x-textarea>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Familias</x-label>
                <x-select name="family_id" class="w-full" wire:model.live="family_id">
                    <option value="" disabled>Selecione una familia</option>
                    @foreach ($this->families as $family)
                        <option value="{{ $family->id }}">
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>

            </div>
            <div class="mb-4">
                <x-label class="mb-1">Categorias</x-label>
                <x-select name="category_id" class="w-full" wire:model.live="category_id">
                    <option value="" disabled>Selecione una categoria</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Subcategorias</x-label>
                <x-select name="subcategory_id" class="w-full" wire:model.live="productEdit.subcategory_id">
                    <option value="" disabled>Selecione una subcategoria</option>
                    @foreach ($this->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Precio</x-label>
                <x-input wire:model="productEdit.price" class="w-full"
                    placeholder="Por favor ingrese el precio del producto" type="number" step="0.01"></x-input>
            </div>
            @empty($product->variants->count()>0)
            <div class="mb-4">
                <x-label class="mb-1">Stock</x-label>
                <x-input wire:model="productEdit.stock" class="w-full"
                    placeholder="Por favor ingrese el stock del producto" type="number" step="0.01"></x-input>
            </div>                
            @endempty

            <div class="flex justify-end">
            <x-danger-button type="button" onclick="confirmDelete()">Eliminar</x-danger-button>
                <x-button>Actualizar</x-button>
            </div>
        </div>
        
    </form>
        {{-- Formulario oculto para eliminar --}}
    <form action="{{ route('admin.products.destroy', $product) }}" id="delete-form" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Sí, bórralo",
                    cancelButtonText: "Cancelar",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
    @endpush
</div>
