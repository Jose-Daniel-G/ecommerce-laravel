<div class="flex flex-col space-y-2">
    @if($shipment->status == \App\Enums\ShipmentStatus::Pending)
 
            <button wire:click="markAsCompleted({{ $shipment->id }})" class="underline text-blue-500 hover:no-underline hover:text-blue-700">
                Marcar como entregado
            </button>
            <br>
            <button wire:click="markAsFailed({{ $shipment->id }})" class="underline text-blue-500 hover:no-underline hover:text-blue-700">
                Marcar como error en la entrega
            </button> 
    @endif 
</div>
