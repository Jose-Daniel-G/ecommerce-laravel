<?php

namespace App\Livewire\Forms\Shipping;

use App\Enums\TypeOfDocuments;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditAddressForm extends Form
{
    public $id;
    public $type = '';
    public $description = '';
    public $district = '';
    public $reference = '';
    public $receiver = '';
    public $receiver_info = [];
    public $default = false;
    public function rules()
    {
        return [
            'type' => 'required|in:1,2',
            'description' => 'required|string',
            'district' => 'required|string',
            'reference' => 'required|string',
            'receiver' => 'required|in:1,2',
            'receiver_info' => 'required|array',
            'receiver_info.name' => 'required|string',
            'receiver_info.last_name' => 'required|string',
            'receiver_info.document_type' => ['required', new Enum(TypeOfDocuments::class)],
            'receiver_info.document_number' => 'required|string|max:50',
            'receiver_info.phone' => ['required', 'regex:/^[0-9]{7,15}$/'],
        ];
    }
    public function validationAttributes()
    {
        return [
            'type' => 'Tipo de direccion',
            'description' => 'Descripcion',
            'district' => 'Distrito',
            'reference' => 'Referencia',
            'receiver' => 'Receptor',
            'receiver_info.name' => 'Nombre',
            'receiver_info.last_name' => 'Apellido',
            'receiver_info.district' => 'Numero de documento',
            'receiver_info.document_number' => 'Numero de documento',
            'receiver_info.phone' => 'Telefono',
        ];
    }
    public function edit($address)
    {
        $this->id = $address->id;
        $this->type = $address->type;
        $this->description = $this->description;
        $this->district = $this->district;
        $this->reference = $this->reference;
        $this->receiver = $this->receiver;
        $this->receiver_info = $this->receiver_info;
        $this->default = $this->default;
    }
}
