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

    public function scopeCget($query, $request) {
        if ($request->filter != null) {
            foreach ($request->filter as $key => $val) {
                $query = $query->where($key, $val);
            }
        }
        if ($request->order != null) {
            $query = $query->offset(($request->order['limit_page'] *($request->order['page'] - 1)))->limit($request->order['limit_page'])
                    ->orderBy($request->order['order_by'], $request->order['sort']);
        }
        $query = $query->get()->map(function($val){
            return $this->mapData($val);
        });
        return $query;
    }

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
            "desa" => $data->masterDesa->nama,
            "kecamatan" => $data->masterKecamatan->nama,
            "kabupaten" => $data->masterKabupaten->nama,
            "provinsi" => $data->masterProvinsi->nama,
            "kodepos" => $data->kodepos,
            "latitude" => $data->latitude,
            "longtitude" => $data->longtitude,
            "coordinate" => [ $data->latitude, $data->longtitude],
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

    public function masterDesa() {
        return $this->belongsTo('App\Models\Wilayah', 'id_desa')->withDefault();
    }
    public function masterKecamatan() {
        return $this->belongsTo('App\Models\Wilayah', 'id_kecamatan')->withDefault();
    }
    public function masterKabupaten() {
        return $this->belongsTo('App\Models\Wilayah', 'id_kabupaten')->withDefault();
    }
    public function masterProvinsi() {
        return $this->belongsTo('App\Models\Wilayah', 'id_provinsi')->withDefault();
    }
}