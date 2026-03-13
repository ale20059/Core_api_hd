<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    protected $fillable = [
        'name',
        'responsibility',
        'description',
        'photo_url',
        'is_active',
    ];
}
