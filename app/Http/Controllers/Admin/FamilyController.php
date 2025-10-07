<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    //    public function __construct()
    // {
    //     $this->middleware('can:manage options');
    // }
    public function index()
    {
        // $families = Family::paginate();
        $families = Family::orderBy('id', 'desc')->paginate(10);

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

        Family::create($data);
        session()->flash('swal',['icon'=>'success', 'title'=>'!Bien echo', 'text'=>'Familia creada correctamente']);

        return redirect()->route('admin.families.index');
    }
    public function edit(Family $family)
    {
        return view('admin.families.edit', compact('family'));
    }
    public function update(Request $request, Family $family)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $family->update($data);
        session()->flash('swal',['icon'=>'success', 'title'=>'!Bien echo', 'text'=>'Familia actualizada correctamente']);
        return redirect()->route('admin.families.edit', $family);
    }
    public function destroy(Family $family)
    {
        if($family->categories->count()){
            session()->flash('swal',['icon'=>'error', 'title'=>'Ups!', 'text'=>'No se puede eliminar la familia porque tiene categorias asociadas']);
            return redirect()->route('admin.families.edit',$family);
        }
        $family->delete();

        session()->flash('swal',['icon'=>'success', 'title'=>'!Bien echo', 'text'=>'Familia eliminada correctamente']);

        return redirect()->route('admin.families.index');
    }
}
