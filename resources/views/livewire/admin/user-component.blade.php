<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuarios</h2>
    </x-slot>
    <div class="container py-12">
        <x-slot name="action">
            <a href="{{ route('admin.drivers.create') }}" class="btn btn-blue">Nuevo</a>
        </x-slot>
        <table>
            <div class="px-6 py-4">
                <x-input type="text" wire:model="search" class="w-full"
                    placeholder="Ingrese el nombre del usuario que quiere buscar" />
            </div>
            @if ($users->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rol</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <span class="sr-only">Editar</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            {{-- @dump($user->toArray())
                        @dump($user->roles->toArray()) --}}
                            <tr wire:key="{{ $user->email }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class=" text-gray-900">{{ $user->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="px-6 py-4 text-gray-900">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="px-6 py-4 text-gray-900">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="px-6 py-4 text-gray-900">
                                        @if (count($user->roles))
                                            Admin
                                        @else
                                            No tiene Rol
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <label><input {{ count($user->roles) ? 'checked' : '' }} type="radio"
                                            name="{{ $user->email }}" value="1"
                                            wire:change="assingRole({{ $user->id }})" wire:change="assignRole({{$user->id}}, event.taget.value)">Si</label>
                                    <label><input {{ count($user->roles) ? '' : 'checked' }} type="radio"
                                            name="{{ $user->email }}" value="0"
                                            wire:change="assingRole({{ $user->id }})" wire:change="assignRole({{$user->id}}, event.taget.value)">No</label>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <!-- Aquí puedes agregar botones o enlaces para acciones como editar o eliminar -->
                                    {{-- <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-900">Editar</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($users->hasPages())
                    <div class="px-6 py-4">
                        {{ $users->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-4">
                    No hay ningún registro coincidente
                </div>
            @endif
        </table>
    </div>
</div>
