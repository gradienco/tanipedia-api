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

    public static function mapData($data) {
        return [
            "id" => $data->id,
            "kategori" => $data->masterKategori->nama,
            "luas" => $data->luas,
            "satuan" => $data->masterSatuan->nama,
            "alamat" => $data->alamat,
            "usia_tanam" => $data->usia_tanam,
            "id_petani" => $data->id_petani,
            "petani" => $data->profilPetani->nama,
            "desa" => $data->id_desa,
            "kecamatan" => $data->id_kecamatan,
            "kabupaten" => $data->id_kabupaten,
            "provinsi" => $data->id_provinsi,
            "kodepos" => $data->kodepos,
            "latitude" => $data->latitude,
            "longtitude" => $data->longtitude,
            "keterangan" => $data->keterangan,
        ];
    }

    public function masterKategori() {
        return $this->belongsTo('App\Models\Master', 'kategori')->withDefault();
    }

    public function masterSatuan() {
        return $this->belongsTo('App\Models\Master', 'satuan')->withDefault();
    }
    
    public function profilPetani() {
        return $this->belongsTo('App\Models\Profil', 'id_petani')->withDefault();
    }

    public function profilInstansi() {
        return $this->belongsTo('App\Models\Instansi', 'id_instansi')->withDefault();
    }
}