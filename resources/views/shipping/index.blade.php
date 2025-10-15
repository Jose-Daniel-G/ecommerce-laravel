<x-app-layout>
    <x-container class="mt-12">
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2">
                @livewire('shipping-addresses')
            </div>
            <div class="col-span-1"></div>
        </div>
    </x-container>
    <div>
    </div>
    {{-- <div class="col-span-1">
        <div class="bg-white rounded-lg shadow"><a href="{{ route('checkout.index') }}">Siguiente</a></div>

    </div> --}}
</x-app-layout>
