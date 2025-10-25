<div class="flex flex-col space-y-2">
    @switch($order->status)
        @case(\App\Enums\OrderStatus::Pending)
            <button class="underline text-blue-500 hover:no-underline">
                Listo para despachar
            </button>
        @break

        @case(\App\Enums\OrderStatus::Processing)
            <button wire:click="markAsProccessing({{ $order->id }})" class="underline text-blue-500 hover:no-underline">
                Asignar repartidor
            </button>
        @break

        @case(\App\Enums\OrderStatus::Failed)
            <button wire:click="markAsRefound({{ $order->id }})" class="underline text-blue-500 hover:no-underline">
                Marcar como devuelto
            </button>
        @break

        @case(\App\Enums\OrderStatus::Refounded)
            <button wire:click="markAsProccessing({{ $order->id }})" class="underline text-blue-500 hover:no-underline">
                Asignar repartidor
            </button>
        @break

        @default
    @endswitch
    @if ($order->status != \App\Enums\OrderStatus::Canceled )
        <button wire:click="cancelOrder({{ $order->id }})" class="underline text-blue-500 hover:no-underline">
            Cancelar
        </button>
    @endif

    {{-- <button wire:click="assignDriver({{$order->id}})" class="underline text-blue-500 hover:no-underline">
        Cancelar
    </button> --}}
</div>
