<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Family;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //    public function __construct()
    // {
    //     $this->middleware('can:manage categories');
    // }
     public function index()
    {
        // $categories = Category::paginate();
        $categories = Category::orderBy('id', 'desc')
        ->with('family')                
        ->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }
    public function create(Request $request)
    {
        $families = Family::all();
        return view('admin.categories.create',compact('families'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'family_id' => 'required|exists:families,id',
            'name' => 'required|string|max:255',
        ]);

        Category::create($data);
        session()->flash('swal',['icon'=>'success', 'title'=>'!Bien echo', 'text'=>'Categoria creada correctamente']);

        return redirect()->route('admin.categories.index');
    }
    public function edit(Category $category)
    {
        $families = Family::all();
        return view('admin.categories.edit', compact('category','families'));
    }
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'family_id' => 'required|exists:families,id',
            'name' => 'required|string|max:255',
        ]);

        $category->update($data);
        session()->flash('swal',['icon'=>'success', 'title'=>'!Bien echo', 'text'=>'Categoria actualizada correctamente']);
        return redirect()->route('admin.categories.edit', $category);
    }
    public function destroy(Category $category)
    {
        if($category->subcategories->count()>0){
            session()->flash('swal',['icon'=>'error', 'title'=>'Ups!', 'text'=>'No se puede eliminar la categoria porque tiene subcategorias asociadas']);
            return redirect()->route('admin.categories.edit',$category);
        }
        session()->flash('swal',['icon'=>'success', 'title'=>'!Bien echo', 'text'=>'Categoria eliminada correctamente']);
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
