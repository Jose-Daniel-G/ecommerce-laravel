<?php

namespace App\Livewire\Products;

use App\Models\Feature;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddToCartVariants extends Component
{
    public $product;
    public $qty = 1;
    public $selectedFeactures = [];
    public function mount()
    {
        foreach ($this->product->options as $option) {
            $features = collect($option->pivot->features);
            $this->selectedFeactures[$option->id] = $features->first()['id'];
        }
    }
    #[Computed]
    public function variant()
    {
        return $this->product->variants->filter(function ($variant) {
            return !array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeactures);
        })->first();
    }
    public function add_to_cart()
    {
        Cart::instance('shopping');
        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => ['image' => $this->variant->image, 'sku' => $this->variant->sku, 'features' => Feature::whereIn('id',$this->selectedFeactures)
                            ->pluck('description','id')->toArray()]
        ]);
        $this->dispatch('swal', ['icon' => 'success', 'title' => 'Bien echo!', 'text' => 'El producto se ha anadido al carrito de compras.']);
    }
    public function render()
    {
        return view('livewire.products.add-to-cart-variants');
    }
}
