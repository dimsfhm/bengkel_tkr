<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_denda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('denda_id')->constrained('denda');
            $table->foreignId('petugas_id')->constrained('user');
            $table->date('tanggal_bayar');
            $table->decimal('jumlah_bayar',10,2);
            $table->enum('status_bayar',['lunas','belum']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran_dendas');
    }
};
