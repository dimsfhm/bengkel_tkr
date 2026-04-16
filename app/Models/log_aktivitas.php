<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log_aktivitas extends Model
{
     protected $table = 'log_aktivitas';

    protected $fillable = [
        'user_id',
        'role',
        'aktivitas'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
