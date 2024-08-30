<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'slug',
        'image',
        'admin_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
