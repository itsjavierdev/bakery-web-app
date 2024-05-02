<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //Mutators and Accessors
    public function name(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return ucwords(strtolower($value));
            }
        );
    }
}
