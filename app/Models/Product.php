<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function featured()
    {
        return $this->belongsTo(Featured::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

    public function sale()
    {
        return $this->belongsToMany(Sale::class);
    }

    use Sluggable;

    public function Sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
