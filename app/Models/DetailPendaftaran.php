<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPendaftaran extends Model
{
    protected $table = 'detail_pendaftaran';

    protected $primaryKey = 'id_detail';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_detail',
        'id_pendaftaran',
        'id_layanan',
        'subtotal',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($detail) {

            $last = self::orderBy(
                'id_detail',
                'desc'
            )
                ->first();

            $nextNumber = $last
                ? ((int) substr($last->id_detail, 1)) + 1
                : 1;

            $detail->id_detail =
                'D' .
                str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        });
    }

    public function pendaftaran()
    {
        return $this->belongsTo(
            Pendaftaran::class,
            'id_pendaftaran',
            'id_pendaftaran'
        );
    }

    public function layanan()
    {
        return $this->belongsTo(
            Layanan::class,
            'id_layanan',
            'id_layanan'
        );
    }
}
