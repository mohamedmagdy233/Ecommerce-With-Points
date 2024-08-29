<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique referral code upon creation
        static::creating(function ($customer) {
            $customer->referral_code = Str::random(10); // Generates a random 10-character code
        });
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);

    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id');
    }

}
