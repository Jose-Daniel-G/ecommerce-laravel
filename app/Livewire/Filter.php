<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;
    public $family_id;
    public $category_id;
    public $subcategory_id;
    public $options;
    public $selected_features = [];
    public $orderBy = 1;
    public $search;

    public function mount()
    {
        $this->options = Option::verifyFamily($this->family_id)
            ->when($this->category_id, function ($query) {
                $query->whereHas('products.subcategory',  function ($query) {
                    $query->where('category_id', $this->category_id);
                })->with(['features' => function ($query) {
                    $query->whereHas('variants.product.subcategory',  function ($query) {
                        $query->where('category_id', $this->category_id);
                    });
                }]);
            })
            ->get()->toArray();

        $this->options = Option::whereHas('products.subcategory.category', function ($query) {
            $query->where('family_id', $this->family_id);
        })->with([
            'features' => function ($query) {
                $query->whereHas(
                    'variants.product.subcategory.category',
                    function ($query) {
                        $query->where('family_id', $this->family_id);
                    }
                );
            }
        ])->get()->toArray();
    }
    #[On('search')]
    public function search($search)
    {
        $this->search = $search;
    }
    public function render()
    {
        $products = Product::verifyFamily($this->family_id)
            ->customOrder($this->orderBy)
            ->verifySubcategory($this->subcategory_id)
            ->SelectFeatures($this->selected_features)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })->paginate(12);
        return view('livewire.filter', compact('products'));
    }
}
