<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable =['name', 'family_id'];

    public function family(){     //relacion uno a muchos inversa
        return $this->belongsTo(Family::class);
    }
    public function subcategories(){ //relacion uno a muchos
        return $this->hasMany(Subcategory::class);
    }
}
