<?php

namespace App\Livewire\Forms\Admin\Options;

use Livewire\Attributes\Validate;
use Livewire\Form;

class NewOptionForm extends Form
{
    public $name;
    public $type = 1;
    public $features = [
        [ 'value'=>'', 'description'=>''],
    ];
}
