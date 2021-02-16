<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalPupuk extends Model
{
    use SoftDeletes;
    
    protected $table = 'jadwal_pupuk';
    protected $primaryKey = 'id';

    protected $fillable = [
        'jenis_pupuk', 'kapasitas', 'satuan', 'id_poktan', 'tgl_distribusi', 'id_instansi'
    ];

}