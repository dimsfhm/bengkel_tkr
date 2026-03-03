<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_peminjaman extends Model
{
    use HasFactory;

    public function peminjaman()
    {
        return $this->belongsTo(peminjaman::class, 'peminjaman_id', 'id');
    }

    public function alat()
    {
        return $this->belongsTo(alat::class, 'alat_id', 'id');
    }
}
