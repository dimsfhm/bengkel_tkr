<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user'; // PENTING

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'alamat'
    ];

    protected $hidden = [
        'password',
    ];
}