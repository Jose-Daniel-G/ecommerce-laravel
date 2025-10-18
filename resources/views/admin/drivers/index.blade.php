<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Conductores',
    ],
]">
<x-slot acction="">
    <a href="{{route('admin.drivers.create')}}" class="btn btn-blue">Nuevo</a>
</x-slot>
</x-admin-layout>
