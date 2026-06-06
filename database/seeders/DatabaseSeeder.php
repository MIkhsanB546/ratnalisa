<?php

namespace Database\Seeders;

use App\Models\DetailPendaftaran;
use App\Models\KategoriLayanan;
use App\Models\Layanan;
use App\Models\Pasien;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        collect([
            [
                'id_kategori' => 'HEM',
                'nama_kategori' => 'Hematologi',
                'keterangan' => 'Pemeriksaan komponen darah dan kondisi hematologi.',
            ],
            [
                'id_kategori' => 'KIM',
                'nama_kategori' => 'Kimia Klinik',
                'keterangan' => 'Pemeriksaan kimia darah dan metabolisme tubuh.',
            ],
            [
                'id_kategori' => 'KON',
                'nama_kategori' => 'Konsultasi',
                'keterangan' => 'Konsultasi dokter umum dan pemeriksaan awal.',
            ],
        ])->map(fn (array $kategori): KategoriLayanan => KategoriLayanan::updateOrCreate(
            ['id_kategori' => $kategori['id_kategori']],
            $kategori
        ));

        collect([
            ['id_kategori' => 'HEM', 'nama_layanan' => 'Hemoglobin', 'harga' => 65000],
            ['id_kategori' => 'HEM', 'nama_layanan' => 'Leukosit', 'harga' => 55000],
            ['id_kategori' => 'HEM', 'nama_layanan' => 'Cek Darah Lengkap', 'harga' => 175000],
            ['id_kategori' => 'KIM', 'nama_layanan' => 'Cek Kolesterol', 'harga' => 85000],
            ['id_kategori' => 'KIM', 'nama_layanan' => 'Cek Gula Darah', 'harga' => 65000],
            ['id_kategori' => 'KON', 'nama_layanan' => 'Konsultasi Dokter Umum', 'harga' => 100000],
            ['id_kategori' => 'KON', 'nama_layanan' => 'Pemeriksaan Kesehatan Umum', 'harga' => 125000],
        ])->each(function (array $layanan): void {
            Layanan::firstOrCreate(
                [
                    'id_kategori' => $layanan['id_kategori'],
                    'nama_layanan' => $layanan['nama_layanan'],
                ],
                [
                    'harga' => $layanan['harga'],
                    'status' => 'aktif',
                ]
            );
        });

        collect([
            ['nama' => 'Admin Ratnalisa', 'username' => 'admin', 'role' => 'admin'],
            ['nama' => 'Customer Service Ratnalisa', 'username' => 'cs', 'role' => 'cs'],
            ['nama' => 'Manager Ratnalisa', 'username' => 'manager', 'role' => 'manager'],
        ])->each(function (array $petugas): void {
            Petugas::firstOrCreate(
                ['username' => $petugas['username']],
                [
                    'nama' => $petugas['nama'],
                    'password' => Hash::make('password'),
                    'role' => $petugas['role'],
                ]
            );
        });

        $layananAktif = Layanan::where('status', 'aktif')->get();

        Pasien::factory()
            ->count(12)
            ->create()
            ->each(function (Pasien $pasien) use ($layananAktif): void {
                Pendaftaran::factory()
                    ->count(fake()->numberBetween(1, 3))
                    ->for($pasien, 'pasien')
                    ->create()
                    ->each(function (Pendaftaran $pendaftaran) use ($layananAktif): void {
                        $layananAktif
                            ->random(fake()->numberBetween(1, min(3, $layananAktif->count())))
                            ->each(function (Layanan $layanan) use ($pendaftaran): void {
                                DetailPendaftaran::create([
                                    'id_pendaftaran' => $pendaftaran->id_pendaftaran,
                                    'id_layanan' => $layanan->id_layanan,
                                    'subtotal' => $layanan->harga,
                                ]);
                            });

                        Pembayaran::factory()
                            ->forPendaftaran($pendaftaran)
                            ->create();
                    });
            });
    }
}
