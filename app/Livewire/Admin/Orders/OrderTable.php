<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Order;
use Illuminate\Container\Attributes\Storage;

class OrderTable extends DataTableComponent
{
    protected $model = Order::class;

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
    public function downloadTicket(Order $orderId)
    {  return Storage::download($orderId->pdf_path);
    }
    public function markAsProccessing(Order $order)
    {
        $order->status = OrderStatus::Processing;
        $order->save();
    }
    public function customView():string{
        return 'admin.orders.table';
    }
}
