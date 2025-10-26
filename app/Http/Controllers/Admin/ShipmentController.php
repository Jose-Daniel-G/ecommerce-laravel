<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    //public function __construct()
    // {
    //     $this->middleware('can:manage shipments');
    // }
    public function index()
    {
        // $shipment = Shipment::all();
        return view('admin.shipments.index');
    }
 
}
