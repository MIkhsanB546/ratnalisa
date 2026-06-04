<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriLayanan extends Model
{
    protected $table = 'kategori_layanan';

    protected $primaryKey = 'id_kategori';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_kategori',
        'nama_kategori',
        'keterangan',
    ];

    public function layanan()
    {
        return $this->hasMany(
            Layanan::class,
            'id_kategori',
            'id_kategori'
        );
    }
}
