<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone',
        'address',
        'profile_picture',
        'date_of_birth',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
