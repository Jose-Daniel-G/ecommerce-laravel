<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategories',
        'route' => route('admin.subcategories.index'),
    ],
    [
        'name' => 'Nuevo',
        'route' => route('admin.subcategories.create'),
    ],
]">
 
    {{-- <form action="{{route('admin.subcategories.store')}}" method="post">
        @csrf
        <div class="mb-2">
            <x-label class="mb-2">Categorias</x-label>
            <x-select name="category_id" class="w-full">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">
                        @selected(old('category_id') == $category->id)
                        {{$category->name}}
                    </option>
                @endforeach
            </x-select>
            <x-label class="mb-2">Nombre</x-label>
            <x-input class="w-full" placeholder="Ingrese el nombre de la familia" name="name" value="{{old('name')}}"></x-input>
        </div>
        <div class="flex justify-end">
            <x-button>Guardar</x-button>
        </div>
    </form> --}}
        @livewire('admin.subcategories.subcategory-create')
</x-admin-layout>
