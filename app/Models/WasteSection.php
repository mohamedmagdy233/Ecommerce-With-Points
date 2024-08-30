<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'point_per_one',
        'image',

    ];
}
