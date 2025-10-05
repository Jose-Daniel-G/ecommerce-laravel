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
        'name' => $subcategory->name,
    ],
]">
    
        @livewire('admin.subcategories.subcategory-edit',compact('subcategory'))

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
