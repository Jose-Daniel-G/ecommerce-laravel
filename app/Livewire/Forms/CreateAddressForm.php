<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateAddressForm extends Form
{
    public $type = '';
    public $description = '';
    public $dristrict = '';
    public $reference = '';
    public $reciver = '';
    public $receiver_info = '';
    public $default = '';
}
