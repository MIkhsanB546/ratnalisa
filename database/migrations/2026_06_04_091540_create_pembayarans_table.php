<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->string('id_pembayaran', 13)->primary();

            $table->string('id_pendaftaran', 12);
            $table->foreign('id_pendaftaran')
                ->references('id_pendaftaran')
                ->on('pendaftaran')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->date('tanggal_bayar');

            $table->enum('metode_bayar', [
                'transfer',
                'qris',
                'tunai',
                'lainnya'
            ]);

            $table->decimal('total_bayar', 12, 2);

            $table->enum('status_bayar', [
                'pending',
                'berhasil',
                'gagal'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
