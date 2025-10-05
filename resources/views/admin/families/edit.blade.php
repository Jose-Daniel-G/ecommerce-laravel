<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index'),
    ],
    [
        'name' => $family->name,
    ],
]">
<div class="card">
    <form action="{{route('admin.families.update',$family)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <x-label class="mb-2">Nombre</x-label>
            <x-input class="w-full" placeholder="Ingrese el nombre de la familia" name="name" value="{{old('name',$family->name)}}"></x-input>
        </div>
        <div class="flex justify-end">
            <x-danger-button onclick="confirmDelete()">Eliminar</x-danger-button>
            <x-button class="ml-2">Actualizar</x-button>
        </div>
    </form>

</div>
<form action="{{route('admin.families.destroy',$family)}}" id="delete-form" method="POST">
    @csrf
    @method('DELETE')
</form>
@push('js')
    <script>
        function confirmDelete(){
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
                    }  
                });
        }
    </script>
@endpush
</x-admin-layout>
