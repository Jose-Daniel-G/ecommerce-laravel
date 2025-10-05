<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id'];
    public function category(){ //relacion uno a muchos inversa
        return $this->belongsTo(Category::class);
    }
    public function products(){ //relacion uno a muchos 
        return $this->hasMany(Product::class);
    }
}
