<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan', function (Blueprint $table) {

            $table->string('id_layanan', 3)->primary();

            $table->string('nama_layanan', 50);

            $table->integer('harga');

            $table->enum('status', [
                'Tersedia',
                'Tidak Tersedia'
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
