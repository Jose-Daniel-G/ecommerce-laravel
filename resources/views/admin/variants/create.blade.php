<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.products.index'),
    ],
    [
        'name' => 'Nuevo',
        'route' => route('admin.products.create'),
    ],
]">
{{-- <div class="card">
    <x-validation-errors class="mb-4"></x-validation-errors>
    <form action="{{route('admin.products.store')}}" method="post">
        @csrf
        <div class="mb-2">
            <x-label class="mb-2">Familia</x-label>
            <x-select name="family_id" class="w-full">
                @foreach ($families as $family)
                    <option value="{{$family->id}}">
                        {{$family->name}}
                    </option>
                @endforeach
            </x-select>
            <x-label class="mb-2">Nombre</x-label>
            <x-input class="w-full" placeholder="Ingrese el nombre de la familia" name="name" value="{{old('name')}}"></x-input>
        </div>
        <div class="flex justify-end">
            <x-button>Guardar</x-button>
        </div>
    </form>

</div> --}}
        @livewire('admin.products.product-create')

</x-admin-layout>
