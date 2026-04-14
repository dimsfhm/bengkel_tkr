<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategori';
    use HasFactory;
    protected $fillable = ['nama_kategori'];

public function alat()
{
    return $this->hasMany(Alat::class);
}
}
