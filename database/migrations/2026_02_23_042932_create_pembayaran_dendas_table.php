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
        Schema::create('pembayaran', function (Blueprint $table) {
    $table->id();

    $table->foreignId('peminjaman_id')
        ->constrained('peminjaman')
        ->cascadeOnDelete();

    $table->enum('metode', ['cash', 'gateway']);

    $table->decimal('jumlah', 12, 2);

    $table->enum('status', [
        'pending',
        'success',
        'failed'
    ])->default('pending');

    $table->string('reference_id')->nullable(); // gateway (midtrans/xendit)

    $table->timestamp('paid_at')->nullable();

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
        Schema::dropIfExists('pembayaran');
    }
};
