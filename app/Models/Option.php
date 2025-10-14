<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = ["name", "type"];

    public function scopeVerifyFamily($query,$family_id){
        $query->when($family_id, function ($query,$family_id) {
            $query->whereHas('products.subcategory.category', function ($query) use ($family_id) {
                $query->where('family_id', $family_id);
            })->with([
                'features' => function ($query) use ($family_id) {
                    $query->whereHas(
                        'variants.product.subcategory.category',
                        function ($query) use ($family_id) {
                            $query->where('family_id', $family_id);
                        }
                    );
                }
            ]);
        });
    }
    public function products()
    { //relacion muchos a muchos
        return $this->belongsToMany(Product::class)
            ->using(OptionProduct::class)
            ->withPivot('features')
            ->withTimestamps();
    }
    public function features()
    { //relacion uno a muchos
        return $this->hasMany(Feature::class);
    }
}
