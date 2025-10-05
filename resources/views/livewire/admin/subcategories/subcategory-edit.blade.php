<div>
    <form wire:submit="save">
        <div class="card">
            <x-validation-errors class="mb-4" />
            <div class="mb-4">
                <x-label class="mb-2">Familias</x-label>
                <x-select class="w-full" wire:model="subcategoryEdit.family_id">
                    <option value="" disabled>Seleccione una familia</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">{{ $family->name }}</option>
                    @endforeach
                </x-select>

                <x-label class="mb-2">Categorías</x-label>
                <x-select class="w-full" wire:model="subcategoryEdit.category_id">
                    <option value="" disabled>Seleccione una categoría</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>

                <x-label class="mb-2">Nombre</x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la subcategoría"
                    wire:model="subcategoryEdit.name" />
            </div>
        </div>

        <div class="flex justify-end">
            <x-danger-button type="button" onclick="confirmDelete()">Eliminar</x-danger-button>
            <x-button class="ml-2">Actualizar</x-button>
        </div>
    </form>

    {{-- Formulario oculto para eliminar --}}
    <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" id="delete-form" method="POST" style="display:none;">
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
