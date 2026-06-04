<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $primaryKey = 'id_pasien';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_pasien',
        'nama',
        'email',
        'password',
        'no_hp',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pasien) {

            $today = now()->format('ymd');

            $lastPasien = self::where('id_pasien', 'like', $today . '%')
                ->orderBy('id_pasien', 'desc')
                ->first();

            $nextNumber = $lastPasien
                ? ((int) substr($lastPasien->id_pasien, -4)) + 1
                : 1;

            $pasien->id_pasien =
                $today .
                str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        });
    }

    public function pendaftaran()
    {
        return $this->hasMany(
            Pendaftaran::class,
            'id_pasien',
            'id_pasien'
        );
    }
}
