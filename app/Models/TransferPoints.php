<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferPoints extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id',
        'to_id',
        'points',
        'admin_id',
    ];

    public function fromCustomer()
    {
        return $this->belongsTo(Customer::class, 'from_id');
    }

    public function toCustomer()
    {
        return $this->belongsTo(Customer::class, 'to_id');

    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
