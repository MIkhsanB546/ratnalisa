<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pendaftaran', function (Blueprint $table) {

            $table->string('id_detail', 7)->primary();

            $table->string('id_pendaftaran', 7);

            $table->string('id_layanan', 3);

            $table->integer('harga');

            $table->integer('jumlah');

            $table->integer('subtotal');

            $table->timestamps();

            // Foreign Key ke tabel pendaftaran
            $table->foreign('id_pendaftaran')
                ->references('id_pendaftaran')
                ->on('pendaftaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Foreign Key ke tabel layanan
            $table->foreign('id_layanan')
                ->references('id_layanan')
                ->on('layanan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pendaftaran');
    }
};
