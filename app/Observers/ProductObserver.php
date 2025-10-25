<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Variant;

class ProductObserver
{
    public function created(Product $product)
    {
        Variant::created([
            'product_id' => $product->id,
            'sku' => 'SKU-' . strtoupper(uniqid()),
            'stock' => 0,
        ]);
    }
}
