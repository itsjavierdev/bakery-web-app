<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function customerAccount()
    {
        return $this->hasOne(CustomerAccount::class);
    }

    public function email(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return $value ?: null;
            }
        );
    }

    public function phone(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return $value ?: null;
            }
        );
    }
}
