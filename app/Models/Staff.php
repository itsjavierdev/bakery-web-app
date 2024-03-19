<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Staff extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
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
    public function surname(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return ucwords(strtolower($value));
            }
        );
    }
}
