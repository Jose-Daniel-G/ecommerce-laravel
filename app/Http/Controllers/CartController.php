<?php

namespace App\Http\Controllers;

use App\Http\Middleware\verifyStock;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(verifyStock::class);
    }
    public function index()
    {
        return view('cart.index');
    }
}
