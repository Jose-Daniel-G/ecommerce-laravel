<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateAddressForm;
use App\Models\Address;
use Livewire\Component;

class ShippingAddress extends Component
{
    public $addresses;
    public $newAddress = true;
    public CreateAddressForm $createAddress;
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
