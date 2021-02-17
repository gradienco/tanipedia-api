<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lahan extends Model
{
    use SoftDeletes;

    protected $table = 'lahan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kategori', 'luas', 'satuan', 'alamat', 'usia_tanam', 'id_petani', 'id_instansi', 'keterangan',
        'id_desa', 'id_kecamatan', 'id_kabupaten', 'id_provinsi', 'latitude', 'longtitude'
    ];

}