<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Conductores',
        'route'=> route('admin.drivers.index')
    ],
    [
        'name' => $driver->user->name,
    ],
]">
    <div class="bg-withe rounded-lg shadow-lg p-8">
        <x-validation-errors class="mb-4"></x-validation-errors>
        <form action="{{ route('admin.drivers.update',$driver) }}" method="POST">@csrf
            @method('PUT')
            <div class="mb-4">
                <label class="mb-1">Usuarios</label>
                <x-select class="w-full" name="user_id">
                    <option selected disabled>Seleccione un usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected($user->id == old('user_id', $driver->user_id,$driver))>{{ $user->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div><x-label class="mb-1"></x-label>Tipo de unidad
                    <x-select class="w-full" name="type">
                        <option value="1" @selected(old('type',$driver) == 1)>Motocicleta</option>
                        <option value="2" @selected(old('type',$driver) == 2)>Automovil</option>
                        <option value="3"></option>
                    </x-select>
                </div>
                <div>
                    <x-label class="mb-1">Placa</x-label>
                    <x-input class="w-full" name="plate_number" value="{{old('plate_number',$driver->plate_number)}}" placeholder="Ingrese la placa vehiculo"></x-input>
                </div>
            </div>
            <div class="flex justify-end space-x-2">
                <x-danger-button id="delete-button">Eliminar</x-danger-button>
                <x-button>Actualizar</x-button>
            </div>
        </form>
    </div>
    <form action="{{ route('admin.drivers.destroy',$driver)}}" method="POST"
        id="deleteForm">
        @csrf
        @method('DELETE')
    </form>
    @push('js')
        <script>
            document.getElementById('delete-button').addEventListener('click', function(){
                document.getElementById('deleteForm').submit();
            });
        </script>
    @endpush
</x-admin-layout>
