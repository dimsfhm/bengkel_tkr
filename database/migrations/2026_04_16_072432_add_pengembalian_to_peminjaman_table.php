<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            // STATUS PENGEMBALIAN
            if (!Schema::hasColumn('peminjaman', 'status_pengembalian')) {
                $table->enum('status_pengembalian', ['belum', 'dikembalikan', 'terlambat', 'rusak'])
                    ->default('belum')
                    ->after('status');
            }

            // TANGGAL KEMBALI
            if (!Schema::hasColumn('peminjaman', 'tanggal_kembali')) {
                $table->date('tanggal_kembali')
                    ->nullable()
                    ->after('tanggal_jatuh_tempo');
            }

            // PETUGAS ADMIN
            if (!Schema::hasColumn('peminjaman', 'petugas_id')) {
                $table->foreignId('petugas_id')
                    ->nullable()
                    ->constrained('users')
                    ->after('status_pengembalian');
            }

        });
    }

    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            if (Schema::hasColumn('peminjaman', 'petugas_id')) {
                $table->dropForeign(['petugas_id']);
                $table->dropColumn('petugas_id');
            }

            if (Schema::hasColumn('peminjaman', 'status_pengembalian')) {
                $table->dropColumn('status_pengembalian');
            }


        });
    }
};