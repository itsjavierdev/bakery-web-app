<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function featured()
    {
        return $this->hasOne(Featured::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details');
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sale_details');
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
