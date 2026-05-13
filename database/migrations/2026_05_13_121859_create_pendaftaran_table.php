<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {

            $table->string('id_pendaftaran', 7)->primary();

            $table->string('id_pasien', 7);

            $table->date('tgl_daftar');

            $table->date('jadwal_pemeriksaan');

            $table->enum('status', [
                'Menunggu',
                'Diproses',
                'Selesai',
                'Batal'
            ]);

            $table->text('catatan')->nullable();

            $table->timestamps();

            // Foreign Key
            $table->foreign('id_pasien')
                ->references('id_pasien')
                ->on('pasien')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
