<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';

    protected $primaryKey = 'id_petugas';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_petugas',
        'nama',
        'username',
        'password',
        'role',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($petugas) {

            $prefixMap = [
                'admin' => 'AD',
                'marketing' => 'MK',
                'manager' => 'MG',
                'cs' => 'CS',
                'staff_pelayanan' => 'SP',
            ];

            $prefix = $prefixMap[$petugas->role] ?? 'PG';

            $lastPetugas = self::where(
                'id_petugas',
                'like',
                $prefix . '%'
            )
                ->orderBy('id_petugas', 'desc')
                ->first();

            $nextNumber = $lastPetugas
                ? ((int) substr($lastPetugas->id_petugas, -3)) + 1
                : 1;

            $petugas->id_petugas =
                $prefix .
                str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        });
    }
}
