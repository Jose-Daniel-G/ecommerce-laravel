<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = ["name", "type"];
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
