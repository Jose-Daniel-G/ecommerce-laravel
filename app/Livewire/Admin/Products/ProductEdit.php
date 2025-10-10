<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;
    public $product;
    public $productEdit;
    public $families;
    public $family_id = '';
    public $category_id = '';
    public $image;

    public function mount($product)
    {
        $this->productEdit = $product->only('sku', 'name', 'description', 'price', 'stock', 'image_path', 'subcategory_id');
        $this->families = Family::all();
        $this->category_id = $product->subcategory->category->id;
        $this->family_id = $product->subcategory->category->family_id;
    }
    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $this->dispatch('swal', ['icon' => 'error', 'title' => 'Error!', 'text' => 'El formulario contiene errores']);
            }
        });
    }
    #[On('variant-generate')]
    public function updateProduct(){
        $this->product = $this->product->fresh();
    }
    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->family_id)->get();
    }
    #[Computed()]
    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->get();
    }
    public function updatedFamilyId()
    {
        $this->category_id = '';
        $this->productEdit['subcategory_id'] = '';
    }
    public function updatedCategoryId()
    {
        $this->productEdit['subcategory_id'] = '';
    }
    public function store()
    {
        $this->validate(['image' => 'nullable|image|max:1170', 
        'productEdit.sku' => 'required|unique:products,sku,'.$this->product->id, 
        'productEdit.name' => 'required|max:255', 'productEdit.description' => 'nullable', 
        'productEdit.price' => 'required|numeric|min:0', 'productEdit.stock' => 'required|numeric|min:0', 
        'productEdit.subcategory_id' => 'required|exists:subcategories,id']);
        if ($this->image) {
            Storage::delete($this->productEdit['image_path']);
            $this->productEdit['image_path'] = $this->image->store('products', 'public');
        }
        $this->product->update($this->productEdit);
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Listo!',
            'text' => 'Producto actualizado correctamente',
        ]);

        return redirect()->route('admin.products.edit', $this->product);
    }
    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
