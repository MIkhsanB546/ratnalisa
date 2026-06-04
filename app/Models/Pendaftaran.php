<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $primaryKey = 'id_pendaftaran';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_pendaftaran',
        'id_pasien',
        'tanggal_daftar',
        'jadwal_periksa',
        'status',
        'catatan',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pendaftaran) {

            $prefix = $pendaftaran->jenis_kunjungan ?? 'KB';

            $date = now()->format('ymd');

            $last = self::where(
                'id_pendaftaran',
                'like',
                $prefix . $date . '%'
            )
                ->orderBy('id_pendaftaran', 'desc')
                ->first();

            $nextNumber = $last
                ? ((int) substr($last->id_pendaftaran, -4)) + 1
                : 1;

            $pendaftaran->id_pendaftaran =
                $prefix .
                $date .
                str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        });
    }

    public function pasien()
    {
        return $this->belongsTo(
            Pasien::class,
            'id_pasien',
            'id_pasien'
        );
    }

    public function detailPendaftaran()
    {
        return $this->hasMany(
            DetailPendaftaran::class,
            'id_pendaftaran',
            'id_pendaftaran'
        );
    }

    public function pembayaran()
    {
        return $this->hasOne(
            Pembayaran::class,
            'id_pendaftaran',
            'id_pendaftaran'
        );
    }
}
