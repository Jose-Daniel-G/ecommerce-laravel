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
        'name' => 'Nuevo',
        'route' => route('admin.families.create'),
    ],
]">
<div class="card">
    <form action="{{route('admin.families.store')}}" method="post">
        @csrf
        <div class="mb-2">
            <x-label class="mb-2">Nombre</x-label>
            <x-input class="w-full" placeholder="Ingrese el nombre de la familia" name="name" value="{{old('name')}}"></x-input>
        </div>
        <div class="flex justify-end">
            <x-button>Guardar</x-button>
        </div>
    </form>

</div>
</x-admin-layout>
