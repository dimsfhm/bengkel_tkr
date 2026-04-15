<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = ['user_id', 'petugas_id', 'tanggal_pinjam', 'tanggal_jatuh_tempo', 'tanggal_kembali', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail()
{
    return $this->hasMany(detail_peminjaman::class);
}

public function pembayaran()
{
    return $this->hasMany(Pembayaran::class);
}

public function denda()
{
    return $this->hasOne(Denda::class);
}

}