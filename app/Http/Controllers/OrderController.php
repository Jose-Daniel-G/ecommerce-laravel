<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    } 

    public function show(Order $order)
    {
        return view('orders.show',compact('order'));
    } 
}
