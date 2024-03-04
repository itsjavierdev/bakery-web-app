<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
