<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Subcategory $subcategory)
    {        return view('subcategories.show',compact('subcategory'));

    }

    public function edit(Subcategory $subcategory)
    {
        //
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        //
    }

    public function destroy(Subcategory $subcategory)
    {
        //
    }
}
