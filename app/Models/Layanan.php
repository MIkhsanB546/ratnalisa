<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';

    protected $primaryKey = 'id_layanan';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_layanan',
        'id_kategori',
        'nama_layanan',
        'harga',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($layanan) {

            if (!empty($layanan->id_layanan)) {
                return;
            }

            $prefix = $layanan->id_kategori;

            $last = self::where(
                'id_layanan',
                'like',
                $prefix . '%'
            )
                ->orderBy('id_layanan', 'desc')
                ->first();

            $nextNumber = $last
                ? ((int) substr($last->id_layanan, -2)) + 1
                : 1;

            $layanan->id_layanan =
                $prefix .
                str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        });
    }

    public function kategori()
    {
        return $this->belongsTo(
            KategoriLayanan::class,
            'id_kategori',
            'id_kategori'
        );
    }

    public function detailPendaftaran()
    {
        return $this->hasMany(
            DetailPendaftaran::class,
            'id_layanan',
            'id_layanan'
        );
    }
}
