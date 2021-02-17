<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Panen extends Model
{
    use SoftDeletes;

    protected $table = 'panen';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_petani', 'id_instansi', 'kategori', 'varietas', 'total_panen', 'satuan', 'tgl_tanam', 'tgl_panen', 'id_lahan', 'keterangan'
    ];
}