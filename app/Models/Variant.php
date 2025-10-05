<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = ["sku","image_path","product_id"];

    public function product()
    { //relacion uno a muchos inversa
        return $this->belongs(Product::class);
    }
    public function features()
    { //relacion muchos a muchos
        return $this->belongsToMany(Feature::class)
            ->withTimestamps();
    }
}
