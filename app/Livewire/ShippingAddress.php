<?php

namespace App\Livewire;

use App\Models\Address;
use Livewire\Component;

class ShippingAddress extends Component
{
    public $addresses;
    public function mount()
    {
        $this->addresses=Address::where('user_id',auth()->id())->get();
        return view('livewire.shipping-address');
    }
    public function render()
    {
        return view('livewire.shipping-address');
    }
}
