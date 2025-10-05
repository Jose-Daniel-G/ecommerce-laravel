<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = ["value","description","option_id"];
    public function options()
    { //relacion uno a muchos inversa
        return $this->belongsTo(Option::class);
    }
    public function variants()
    { //relacion muchos a muchos
        return $this->belongsToMany(Variant::class)
            ->withTimestamps();
    }
}
