<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'referral_code',
        'points',
        'password',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
