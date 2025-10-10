<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //public function __construct()
    // {
    //     $this->middleware('can:manage products');
    // }
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

        session()->flash('swal', ['icon' => 'success', 'title' => '!Bien echo', 'text' => 'Producto eliminado correctamente']);

        return redirect()->route('admin.products.index');
    }
    public function variants(Product $product, Variant $variant)
    {
        // return $variant;
        return view('admin.products.variants', compact('product', "variant"));
    }
    public function variantsUpdate(Request $request, Product $product, Variant $variant)
    {
        $data = $request->validate(['image' => 'nullable|image|max:1170', 'sku' => 'required', 'stock' => 'required|numeric|min:0']);
        if ($request->image) {
            if ($variant->image_path) {
                Storage::delete($variant->image_path);
            }
            $data['image_path'] = $request->image->store('products');
        }
        $variant->update($data);
        session()->flash('swal', ['icon' => 'success', 'title' => '!Bien echo', 'text' => 'La variante se actualizo correctamente']);
        return redirect()->route('admin.products.variants', [$product, $variant]);
    }
}
