<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['sku', 'name', 'description', 'image_path', 'price', 'stock', 'subcategory_id'];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->isUrl($this->image_path) ? $this->image_path : Storage::url($this->image_path)
        );
    }
    private function isUrl($path): bool
    {
        return filter_var($path, FILTER_VALIDATE_URL) !== false;
    }
    // protected function image(): Attribute //original
    // {
    //     return Attribute::make(get: fn() => Storage::url($this->image_path));
    // }
    public function scopeVerifyFamily($query, $family_id)
    {
        $query->when($family_id, function ($query, $family_id) {
            $query->whereHas('subcategory.category', function ($query) use ($family_id) {
                $query->where('family_id', $family_id);
            });
        });
    }
    public function scopeVerifyCategory($query, $family_id)
    {
        $query->when($this->category_id, function ($query) {
            $query->whereHas('subcategory',  function ($query) {
                $query->where('category_id', $this->category_id);
            });
        });
    }
    public function scopeVerifySubcategory($query, $family_id)
    {
        $query->when($this->subcategory_id, function ($query) {
            $query->where('subcategory_id', $this->subcategory_id);
        });
    }
    public function scopeCustomOrder($query)
    {
        $query->when($this->orderBy == 1, function ($query) {
            $query->orderBy('created_at', 'desc');
        })
            ->when($this->orderBy == 2, function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->when($this->orderBy == 3, function ($query) {
                $query->orderBy('price', 'asc');
            });
    }
    public function scopeSelectFeatures($query)
    {
        $query->when($this->selected_features, function ($query) {
            $query->whereHas('variants.features', function ($query) {
                $query->whereIn('features.id', $this->selected_features);
            });
        });
    }
    public function subcategory()
    { //relacion muchos a muchos inversa
        return $this->belongsTo(Subcategory::class);
    }

    public function variants()
    { //relacion uno a muchos
        return $this->hasMany(Variant::class);
    }

    public function options()
    { //relacion muchos a muchos
        return $this->belongsToMany(Option::class)
            ->using(OptionProduct::class)
            ->withPivot('features')
            ->withTimestamps();
    }
}
