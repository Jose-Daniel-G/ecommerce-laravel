<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
      public function index()
    {
        // $families = Category::paginate();
        $families = Category::orderBy('id', 'desc')->paginate(10);

        return view('admin.families.index', compact('families'));
    }
    public function create(Request $request)
    {
        return view('admin.families.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($data);
        session()->flash('swal',['icon'=>'success', 'title'=>'!bien echo', 'text'=>'Familia creada correctamente']);

        return redirect()->route('admin.families.index');
    }
    public function edit(Category $family)
    {
        return view('admin.families.edit', compact('family'));
    }
    public function update(Request $request, Category $family)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $family->update($data);
        session()->flash('swal',['icon'=>'success', 'title'=>'!bien echo', 'text'=>'Familia actualizada correctamente']);
        return redirect()->route('admin.families.edit', $family);
    }
    public function destroy(Category $family)
    {
        $family->delete();
        if($family->categories->count()){
        session()->flash('swal',['icon'=>'error', 'title'=>'Ups!', 'text'=>'No se puede eliminar la familia porque tiene categorias asociadas']);
        return redirect()->route('admin.families.edit',$family);

        }
        session()->flash('swal',['icon'=>'success', 'title'=>'!bien echo', 'text'=>'Familia eliminada correctamente']);

        return redirect()->route('admin.families.index');
    }
}
