<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alat extends Model
{
    use HasFactory;

    protected $table = 'alat';

    public function detail_peminjaman()
    {
        return $this->hasMany(detail_peminjaman::class, 'alat_id', 'id');
    }
}
