<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Covers',
    ],
]">
    <x-slot name="action"><a href="{{ route('admin.covers.create') }}" class="btn btn-blue">Nuevo</a></x-slot>
    <ul class="space-y-4" id="covers">
        @foreach ($covers as $cover)
            <li class="bg-white rounded-lg shadow-lg lg:flex overflow-hidden cursor-move" data-id="{{ $cover->id }}">
                <img src="{{ $cover->image }}" alt=""
                    class="w-full lg:w-64 aspect-[3/1] object-cover object-center">
                <div class="p-4 lg:flex-1 lg:flex lg:justify-between lg:items-center space-y-2 lg:space-y-0">
                    <div>
                        <h1 class="font-semibold">{{ $cover->title }}</h1>
                        <p>
                            @if ($cover->is_active)
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Activo</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Inactivo</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="font-bold text-sm">Fecha inicio</p>
                        <p>{{ $cover->start_at->format('d/m/y') }}</p>
                    </div>
                    <div>
                        <p class="font-bold text-sm">Fecha Fin</p>
                        <p>{{ $cover->end_at?->format('d/m/y') ?? '-' }}</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.covers.edit', $cover) }}" class="btn btn-blue">Editar</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        <script>
            new Sortable(covers, {
                animation: 150,
                ghostClass: 'bg-blue-100',
                store: {
                    set: (sortable) => {
                        const sorts = sortable.toArray();
                        axios.post('{{ route('api.sort.covers') }}', {
                                sorts: sorts
                            })
                            .catch((error) => {
                                console.log(error);
                            });
                    }
                }
            });
        </script>
    @endpush
</x-admin-layout>
