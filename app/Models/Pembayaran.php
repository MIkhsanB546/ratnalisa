<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_pembayaran',
        'id_pendaftaran',
        'tanggal_bayar',
        'metode_bayar',
        'total_bayar',
        'status_bayar',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pembayaran) {

            if (!empty($pembayaran->id_pembayaran)) {
                return;
            }

            $date = Carbon::parse($pembayaran->tanggal_bayar ?? now())->format('ymd');

            $last = self::where(
                'id_pembayaran',
                'like',
                'INV' . $date . '%'
            )
                ->orderBy('id_pembayaran', 'desc')
                ->first();

            $nextNumber = $last
                ? ((int) substr($last->id_pembayaran, -4)) + 1
                : 1;

            $pembayaran->id_pembayaran =
                'INV' .
                $date .
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
}
