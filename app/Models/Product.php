<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['sku','name', 'description', 'image_path', 'price', 'stock','subcategory_id'];

    protected function image():Attribute{
        return Attribute::make(get: fn()=>Storage::url($this->image_path));
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
