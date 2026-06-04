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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->string('id_pendaftaran', 12)->primary();

            $table->string('id_pasien', 10);
            $table->foreign('id_pasien')
                ->references('id_pasien')
                ->on('pasien')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->date('tanggal_daftar');
            $table->dateTime('jadwal_periksa');

            $table->enum('status', [
                'menunggu',
                'dijadwalkan',
                'selesai',
                'batal'
            ]);

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
