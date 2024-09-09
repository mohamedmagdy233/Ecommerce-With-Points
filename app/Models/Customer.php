<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;  // Ensure this is correctly added

class Customer extends Model implements AuthenticatableContract
{
    use Authenticatable, HasFactory;  // Correct placement

    protected $fillable = [
        'name',
        'phone',
        'address',
        'referral_code',
        'points',
        'password',
        'customer_id',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function customers()
    {

        return $this->hasMany(Customer::class);


    }
}
