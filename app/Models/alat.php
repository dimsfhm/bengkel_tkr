<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alat extends Model
{
    use HasFactory;

    protected $table = 'alat';
    protected $fillable = ['kategori_id', 'nama_alat', 'jumlah_total', 'kondisi_baik', 'kondisi_rusak'];

    public function kategori()
{   
    return $this->belongsTo(Kategori::class);
}

    public function detail_peminjaman()
    {
        return $this->hasMany(detail_peminjaman::class, 'alat_id', 'id');
    }
}
