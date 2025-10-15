<header class="bg-gray-900 px-4 py-2">
    <h1 class="text-white text-lg">Direcciones de envio guardadas</h1>
</header>
<div class="p-4">
    @if ($newAddress)
        <p>Aqui se mostrara el formulario</p>
    @else
        @if ($addresses->count())
        @else
            <p class="text-center">No se ha encontrado direcciones</p>
        @endif

    @endif
    <button wire:click="$set('newAddress',true)" class="btn btn-outline-gray w-full items-center justify-center mt-4">
        Agregar<i class="fa-solid fa-plus ml-2"></i>
    </button>
</div>
