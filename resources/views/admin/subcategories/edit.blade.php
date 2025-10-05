<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => $category->name,
    ],
]">
    <div class="card">
        <form action="{{ route('admin.categories.update', $category) }}" method="post">
            @csrf
            @method('PUT')
            <x-label class="mb-2">Familia</x-label>
            <x-select name="category_id" class="w-full">
                @foreach ($subcategories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $category->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>
            <div class="mb-2">
                <x-label class="mb-2">Nombre</x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la familia" name="name"
                    value="{{ old('name', $category->name) }}"></x-input>
            </div>
            <div class="flex justify-end">
                <x-danger-button onclick="confirmDelete()">Eliminar</x-danger-button>
                <x-button class="ml-2">Actualizar</x-button>
            </div>
        </form>

    </div>
    <form action="{{ route('admin.categories.destroy', $category) }}" id="delete-form" method="POST">
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
                    title: "Estas seguro?",
                    text: "No podras revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Si, borralo!",
                    cancelButtonText: "Cancelar",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();

                        // swalWithBootstrapButtons.fire({
                        //     title: "Deleted!",
                        //     text: "Your file has been deleted.",
                        //     icon: "success"
                        // });
                    } 
                });
            }
        </script>
    @endpush
</x-admin-layout>
