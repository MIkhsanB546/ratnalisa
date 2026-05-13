<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {

            $table->string('id_pembayaran', 7)->primary();

            $table->string('id_pendaftaran', 7);

            $table->integer('total_bayar');

            $table->enum('metode_bayar', [
                'Transfer',
                'Cash',
                'E-Wallet'
            ]);

            $table->enum('status_bayar', [
                'Belum Bayar',
                'Lunas',
                'Gagal'
            ]);

            $table->timestamps();

            // Foreign Key
            $table->foreign('id_pendaftaran')
                ->references('id_pendaftaran')
                ->on('pendaftaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
