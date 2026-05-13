<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {

            $table->string('id_pasien', 7)->primary();
            $table->string('nama', 50);
            $table->string('email', 50)->unique();
            $table->string('password', 100);
            $table->string('no_hp', 15);
            $table->date('tgl_lahir');

            $table->enum('jenis_kelamin', ['L', 'P']);
            // atau:
            // ['Laki-laki', 'Perempuan']

            $table->text('alamat');

            $table->string('gol_darah', 3)->nullable();
            // contoh: A, B, AB, O

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
