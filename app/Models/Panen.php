<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Panen extends Model
{
    use SoftDeletes;

    protected $table = 'panen';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_petani', 'id_instansi', 'kategori', 'varietas', 'total_panen', 'satuan', 'tgl_tanam', 'tgl_panen', 'id_lahan', 'keterangan'
    ];

    public function scopeCget($query, Request $request) {
        $sort = "ASC";
        foreach ($request->all() as $key => $val) {
            if ($key == "limit_page")
                $query = $query->limit($request->limit_page);
            else if ($key == "page") 
                $query = $query->offset(($request->limit_page *($request->page - 1)));
            else if ($key == "order_by")
                $orderBy = $val;
            else if ($key == "sort")
                $sort = $val;
            else  
                $query = $query->where($key, $val);
        }   
        if ($request->order_by != null)
            $query = $query->orderBy($orderBy, $sort);
            
        $query = $query->get()->map(function($val){
            return $this->mapData($val);
        });
        return $query;
    }

    public static function mapData($data) {
        return [
            "id" => $data->id,
            "kategori" => $data->masterKategori->nama,
            "varietas" => $data->varietas,
            "total_panen" => $data->total_panen,
            "satuan" => $data->masterSatuan->nama,
            "usia_tanam" => $data->usia_tanam,
            "id_petani" => $data->id_petani,
            "petani" => $data->profilPetani->nama,
            "id_instansi" => $data->id_instansi,
            // "instansi" => $data->profilInstansi->nama,
            "id_lahan" => $data->id_lahan,
            "lahan" => $data->profilLahan,
            "tgl_tanam" => $data->tgl_tanam,
            "tgl_panen" => $data->tgl_panen,
            "keterangan" => $data->keterangan,
            "foto_panen" => $data->foto_panen
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
    public function profilLahan() {
        return $this->belongsTo('App\Models\Lahan', 'id_lahan')->withDefault();
    }
}