<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Login extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'login'; // Specify the custom table name

    protected $fillable = [
        'fullname',
        'useremail',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
