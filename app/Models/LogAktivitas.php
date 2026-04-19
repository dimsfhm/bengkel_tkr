<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LogAktivitas extends Model
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