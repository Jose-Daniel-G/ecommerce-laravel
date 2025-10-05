<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        // $subcategories = Subcategory::paginate();
        $subcategories = Subcategory::with('category.family')   
        ->orderBy('id', 'desc')             
        ->paginate(10);

        return view('admin.subcategories.index', compact('subcategories'));
    }
    public function create(Request $request)
    {
        $categories = Category::all();
        return view('admin.subcategories.create',compact('categories'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        Subcategory::create($data);
        session()->flash('swal',['icon'=>'success', 'title'=>'!Bien echo', 'text'=>'Subcategoria creada correctamente']);

        return redirect()->route('admin.subcategories.index');
    }
    public function edit(Subcategory $category)
    {
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('category','categories'));
    }
    public function update(Request $request, Subcategory $category)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $category->update($data);
        session()->flash('swal',['icon'=>'success', 'title'=>'!Bien echo', 'text'=>'Subcategoria actualizada correctamente']);
        return redirect()->route('admin.subcategories.edit', $category);
    }
    public function destroy(Subcategory $category)
    {
        if($category->subsubcategories->count()>0){
            session()->flash('swal',['icon'=>'error', 'title'=>'Ups!', 'text'=>'No se puede eliminar la categoria porque tiene subcategorias asociadas']);
            return redirect()->route('admin.subcategories.edit',$category);
        }
        session()->flash('swal',['icon'=>'success', 'title'=>'!Bien echo', 'text'=>'Subcategoria eliminada correctamente']);
        $category->delete();

        return redirect()->route('admin.subcategories.index');
    }
}
