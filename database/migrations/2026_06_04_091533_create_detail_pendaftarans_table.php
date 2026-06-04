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
        Schema::create('detail_pendaftaran', function (Blueprint $table) {
            $table->string('id_detail', 5)->primary();

            $table->string('id_pendaftaran', 12);
            $table->foreign('id_pendaftaran')
                ->references('id_pendaftaran')
                ->on('pendaftaran')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('id_layanan', 5);
            $table->foreign('id_layanan')
                ->references('id_layanan')
                ->on('layanan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->decimal('subtotal', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pendaftarans');
    }
};
