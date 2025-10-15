<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
]">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex item-center">
                <img src="{{ Auth::user()->profile_photo_url }}" class="h-8 w-8 rounded-full object-cover"
                    alt="{{ Auth::user()->name }}" />
                <div class="ml-4 flex-1">
                    <h2 class="text-lg font-semibold">Bienvenido {{ auth()->user()->name }}</h2>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="test-sm hover:text-blue-500">Cerrar sesion</button>
                </form>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 flex item-center justify-center">
            <div class="text-xl fornt-semibold">
                Twins</div>
            <button @click="darkMode = !darkMode">🌗 Cambiar modo</button>

        </div>
    </div>
</x-admin-layout>
