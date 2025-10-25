<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use App\Enums\ShipmentStatus;
use App\Models\Driver;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Container\Attributes\Storage;

class OrderTable extends DataTableComponent
{
    protected $model = Order::class;
    public $new_shipment = ['openModal' => true, 'order_id' => '', 'driver_id' => ''];
    public $drivers;

    public function mount()
    {
        $this->drivers = Driver::all();
        // $this->drivers = \App\Models\User::where('role', 'driver')->get();
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("No orden", "id")
                ->sortable(),
            Column::make("Ticket")
                ->label(function ($row) {
                    return view('admin.orders.ticket', ['order' => $row]);
                })
                ->sortable(),
            Column::make("F. orden", "created_at")
                ->format(function () {
                    return $this->created_at->format('d/m/Y');
                })
                ->sortable(),
            Column::make("total")
                ->format(function () {
                    return '$' . number_format($this->total, 2);
                })
                ->sortable(),
            Column::make("Cantidad", "content")
                ->format(function ($value) {
                    return count($value);
                })
                ->sortable(),
            Column::make("Estado", "status")
                ->format(function ($value) {
                    return $value->name;
                })
                ->sortable(),
            Column::make("Actions")
                ->label(function ($row) {
                    return view('admin.orders.actions', ['order' => $row]);
                })
                ->sortable(),
        ];
    }
    public function downloadTicket(Order $order_id)
    {
        return Storage::download($order_id->pdf_path);
    }
    public function markAsProccessing(Order $order)
    {
        $order->status = OrderStatus::Processing;
        $order->save();
    }
    public function assignDriver(Order $order)
    {
        $this->new_shipment['openModal'] = true;
        $this->new_shipment['order_id'] = $order->id;
    }
    public function saveShipment()
    {
        $this->validate([
            'new_shipment.driver_id' => 'required|exists:drivers,id',
        ]);
        $order = Order::find($this->new_shipment['order_id']);
        $order->status = OrderStatus::Shipped;
        $order->save();
        $order->saveShipment()->create([
            'driver_id' => $this->new_shipment['driver_id'],
            'shipped_at' => now(),
        ]);
        $this->reset('new_shipment');
    }
    public function markAsRefounded(Order $order)
    {
        $order->status = OrderStatus::Refounded;
        $order->save();

        $shipment = $order->shipments->last();
        $shipment->refounded_at = now();
        $shipment->save();
    }
    public function cancelOrder(Order $order)
    { 
        if ($order->status == ShipmentStatus::Shipped) {
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'No se puede cancelar la orden',
                'text' => 'La order tiene envios pendientes.',
            ]);
            return;
        }
        if ($order->count() > 0) {
            $this->dispatchBrowserEvent('swal', [
                'icon' => 'error',
                'title' => 'No se puede cancelar la orden',
                'text' => 'El pedido no ha sido enviado.',
            ]);
            return;
        }
        $order->status = OrderStatus::Cancelled;
        $order->save();
    }
    public function customView(): string
    {
        return 'admin.orders.modal';
    }
}
