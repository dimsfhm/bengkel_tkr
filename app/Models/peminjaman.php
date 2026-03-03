<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';

    public function detail_peminjaman()
    {
        return $this->hasMany(detail_peminjaman::class, 'peminjaman_id', 'id');
    }
}
