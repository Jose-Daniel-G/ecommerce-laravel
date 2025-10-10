<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = ["sku","stock","image_path","product_id"];

    protected function image():Attribute
    { return Attribute::make(get: fn()=>$this->image_path ? Storage::url($this->image_path): asset('img/n-image.png')) ;
    }
    public function product()
    { //relacion uno a muchos inversa
        return $this->belongsTo(Product::class);
    }
    public function features()
    { //relacion muchos a muchos
        return $this->belongsToMany(Feature::class)
            ->withTimestamps();
    }
}
