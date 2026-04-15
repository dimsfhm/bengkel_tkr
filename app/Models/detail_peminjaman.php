<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_peminjaman extends Model
{
    protected $table = 'detail_peminjaman';
    protected $fillable = ['peminjaman_id', 'alat_id', 'jumlah_pinjam', 'kondisi_kembali'];

    public function peminjaman()
{
    return $this->belongsTo(Peminjaman::class);
}

public function alat()
{
    return $this->belongsTo(Alat::class);
}
}