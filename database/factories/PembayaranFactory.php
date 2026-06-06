<?php

namespace Database\Factories;

use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pembayaran>
 */
class PembayaranFactory extends Factory
{
    protected $model = Pembayaran::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pendaftaran' => Pendaftaran::factory(),
            'tanggal_bayar' => fake()->dateTimeBetween('-14 days', 'now')->format('Y-m-d'),
            'metode_bayar' => fake()->randomElement(['transfer', 'qris', 'tunai', 'lainnya']),
            'total_bayar' => 0,
            'status_bayar' => fake()->randomElement(['belum_lunas', 'lunas', 'gagal']),
        ];
    }

    public function forPendaftaran(Pendaftaran $pendaftaran): static
    {
        return $this->state(fn (array $attributes): array => [
            'id_pendaftaran' => $pendaftaran->id_pendaftaran,
            'tanggal_bayar' => $pendaftaran->tanggal_daftar,
            'total_bayar' => $pendaftaran->detailPendaftaran()->sum('subtotal'),
        ]);
    }

    public function belumLunas(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status_bayar' => 'belum_lunas',
        ]);
    }

    public function lunas(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status_bayar' => 'lunas',
        ]);
    }

    public function gagal(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status_bayar' => 'gagal',
        ]);
    }
}
