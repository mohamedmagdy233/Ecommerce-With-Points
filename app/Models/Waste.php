<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'waste_section_id',
        'admin_id',
        'customer_id',
        'points_transferred',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function wasteSection()
    {
        return $this->belongsTo(WasteSection::class);
    }
}
