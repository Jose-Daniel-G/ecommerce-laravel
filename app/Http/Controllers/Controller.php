<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{   //JDGO ADD: to be able to use AuthorizesRequests and ValidatesRequests in all controllers
    use AuthorizesRequests, ValidatesRequests;
}
