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

    public function masterGender() {
        return $this->belongsTo('App\Models\Master', 'gender')->withDefault();
    }
    public function maseterAgama() {
        return $this->belongsTo('App\Models\Master', 'agama')->withDefault();
    }
    public function masterPendidikan() {
        return $this->belongsTo('App\Models\Master', 'pendidikan')->withDefault();
    }
    public function masterGolDarah() {
        return $this->belongsTo('App\Models\Master', 'gol_darah')->withDefault();
    }
    public function masterSuku() {
        return $this->belongsTo('App\Models\Master', 'suku')->withDefault();
    }
    public function masterPekerjaan() {
        return $this->belongsTo('App\Models\Master', 'pekerjaan')->withDefault();
    }

}