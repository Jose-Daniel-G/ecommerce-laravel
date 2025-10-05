<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['sku','name', 'description', 'image_path', 'price', 'subcategory_id'];

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
            ->withPivot('value')
            ->withTimestamps();
    }
}
