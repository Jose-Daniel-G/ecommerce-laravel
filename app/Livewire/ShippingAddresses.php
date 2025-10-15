<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateAddressForm;
use App\Livewire\Forms\Shipping\EditAddressForm;
use App\Models\Address;
use Livewire\Component;

class ShippingAddresses extends Component
{
    public $addresses;
    public $newAddresses = false;
    public CreateAddressForm $createAddress;
    public EditAddressForm $editAddress;
    public function mount()
    {
        $this->addresses = Address::where('user_id', auth()->id())->get();
        $this->createAddress->receiver_info = [
            'name' => auth()->user()->name,
            'lastname' => auth()->user()->lastname,
            'document_type' => auth()->user()->document_type,
            'document_number' => auth()->user()->document_number,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone,
            // 'password'=> auth()->user()->password,
        ];
    }
    public function store()
    {
        $this->createAddress->save();
        $this->addresses = Address::where('user_id', auth()->id())->get();
        $this->newAddresses = false;
    }
    public function edit($id)
    {
        $address = Address::find($id);
        $this->editAddress->edit($address);
    }
    public function deleteAddress($id)
    {
        Address::find($id)->delete();
        $this->addresses = Address::where('user_id', auth()->id())->get();
        if (Address::where('default', true)->get()) {
            $this->addresses->first()->update(['default']);
        }
    }
    public function setDefaultAddress($id)
    {
        $this->addresses->each(function ($address) use ($id) {
            $address->update(['default' => $address->id == $id]);
        });
    }
    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
