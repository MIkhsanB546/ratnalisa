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
        Schema::create('layanan', function (Blueprint $table) {
            $table->string('id_layanan', 5)->primary();

            $table->string('id_kategori', 3);
            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori_layanan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('nama_layanan', 100);
            $table->decimal('harga', 12, 2);
            $table->enum('status', ['aktif', 'nonaktif']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
