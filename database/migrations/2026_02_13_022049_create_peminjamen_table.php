<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status', ['pending','disetujui','ditolak','dipinjam','selesai'])->default('pending');
            $table->enum('payment_status', ['unpaid','pending','paid'])->default('unpaid');
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('denda_total', 12, 2)->default(0);
            $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
};