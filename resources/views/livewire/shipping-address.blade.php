<header class="bg-gray-900 px-4 py-2">
    <h1 class="text-white text-lg">Direcciones de envio guardadas</h1>
</header>
<div class="p-4">
    @if ($addresses->count())
        
    @else
        <p class="text-center">No se ha encontrado direcciones</p>
    @endif
</div>