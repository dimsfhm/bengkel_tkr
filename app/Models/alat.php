<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alat extends Model
{
    use HasFactory;

    protected $table = 'alats';
    protected $fillable = ['kategori_id', 'nama_alat', 'jumlah_total', 'harga', 'gambar'];

    public function kategori()
{   
    return $this->belongsTo(Kategori::class);
}

    public function detail_peminjaman()
    {
        return $this->hasMany(detail_peminjaman::class, 'alat_id', 'id');
    }

    public function alat()
{
    return $this->belongsTo(Alat::class, 'alat_id');
}
}
