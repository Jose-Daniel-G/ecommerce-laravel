<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryEdit extends Component
{
    public $families;
    public $subcategory;
    public $subcategoryEdit;

    public function mount($subcategory)
    {
        $this->subcategory = $subcategory;
        $this->families = Family::all();
        $this->subcategoryEdit = [
            'family_id' =>  $subcategory->category->family_id,
            'category_id' =>  $subcategory->category_id,
            'name' =>  $subcategory->name,
        ];
    }
    public function updatedSubcategoryEditFamilyId()
    {
        $this->subcategoryEdit['category_id'] = '';
    }
    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->subcategoryEdit['family_id'])->get();
    }
    public function save()
    {
        // dd($this->subcategoryEdit);

        $this->validate([
            'subcategoryEdit.family_id' => 'required|exists:families,id',
            'subcategoryEdit.category_id' => 'required|exists:categories,id',
            'subcategoryEdit.name' => 'required|string|max:255',
        ]);

        $this->subcategory->update($this->subcategoryEdit);
        // session()->flash('swal', ['icon' => 'success', 'title' => '!Bien echo', 'text' => 'Subcategoria creada correctamente']);
        $this->dispatch('swal',['icon' => 'success', 'title' => '!Bien echo', 'text' => 'Subcategoria Actualizada correctamente']);
        return redirect()->route('admin.subcategories.index');
    }
    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-edit');
    }
}
