<?php

namespace Database\Factories;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pendaftaran>
 */
class PendaftaranFactory extends Factory
{
    protected $model = Pendaftaran::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggalDaftar = fake()->dateTimeBetween('-30 days', '+7 days');
        $jadwalPeriksa = (clone $tanggalDaftar)->modify('+' . fake()->numberBetween(1, 5) . ' days');

        return [
            'id_pasien' => Pasien::factory(),
            'tanggal_daftar' => $tanggalDaftar->format('Y-m-d'),
            'jadwal_periksa' => $jadwalPeriksa->format('Y-m-d H:i:s'),
            'status' => fake()->randomElement(['menunggu', 'dijadwalkan', 'selesai', 'batal']),
            'catatan' => fake()->optional(0.55)->sentence(),
        ];
    }

    public function menunggu(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'menunggu',
        ]);
    }

    public function dijadwalkan(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'dijadwalkan',
        ]);
    }

    public function selesai(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'selesai',
        ]);
    }

    public function batal(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'batal',
        ]);
    }
}
