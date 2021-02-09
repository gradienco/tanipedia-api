<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profil extends Model
{
    use SoftDeletes;
    
    protected $table = 'profil';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama', 'nik', 'kk', 'kategori', 'pekerjaan', 'gender', 'agama', 'suku', 'tgl_lahir', 'pendidikan', 
        'alamat', 'rt', 'rw', 'id_desa', 'id_kecamatan', 'id_kabupaten', 'id_provinsi', 'kodepos', 'latitude', 'longtitude',
        'gol_darah', 'telp', 'email', 'facebook', 'id_user'
    ];
}