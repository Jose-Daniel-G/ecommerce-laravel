<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::paginate();
        $products = Product::orderBy('id', 'desc')->paginate(10);

        return view('admin.products.index', compact('products'));
    }
    public function create(Request $request)
    {
        return view('admin.products.create');
    }
 
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }
 
    public function destroy(Product $product)
    {
        Storage::delete($product->image_path);
 
        $product->delete();

        session()->flash('swal',['icon'=>'success', 'title'=>'!Bien echo', 'text'=>'Producto eliminado correctamente']);

        return redirect()->route('admin.products.index');
    }
}
