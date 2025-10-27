<?php

namespace App\Livewire\Products;

use App\Models\Feature;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    public $variant;
    public $qty = 1;
    public $stock;
    public $selectedFeatures = [];

    public function mount()
    { 
        $this->selectedFeatures = $this->product->variants->first()->features->pluck('id','option_id')->toArray();
        $this->getVariant();
    }  
    public function updatedSelectedFeatures()
    {
        $this->getVariant();
    }
    public function getVariant()
    {
        $this->variant = $this->product->variants->filter(function ($variant) {
            return !array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeatures);
        })->first();
        $this->stock = $this->variant->stock;
        $this->qty = 1;
    }
    public function add_to_cart()
    {
        Cart::instance('shopping');

        //Existe algun producto cuyo sku sea igual al de la variante seleccionada
        $cartItem = Cart::search(function ($cartItem) {
            return $cartItem->options->sku === $this->variant->sku;
        })->first();    

        if ($cartItem) {
                $stock = $this->variant->stock - $cartItem->qty;
                if ($this->qty > $stock) {
                    $this->dispatch('swal', ['icon' => 'error', 'title' => 'Ups!', 'text' => 'No hay suficiente stock disponible. Solo quedan ' . $stock . ' unidades.']);
                    return;
                }
        }
        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => ['image' => $this->product->image, 'sku' => $this->variant->sku,'stock' => $this->variant->stock, 'features' => Feature::whereIn('id', $this->selectedFeatures)
                ->pluck('description', 'id')->toArray()]
        ]);
        if (auth()->check()) {
            Cart::store(auth()->id());
        }
        $this->dispatch('cartUpdate', Cart::count());
        $this->dispatch('swal', ['icon' => 'success', 'title' => 'Bien echo!', 'text' => 'El producto se ha anadido al carrito de compras.']);
    }
    public function render()
    {
        return view('livewire.products.add-to-cart');
    }
}
