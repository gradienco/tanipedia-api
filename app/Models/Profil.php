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
            "nama" => $data->nama,
            "nik" => $data->nik,
            "kk" => $data->kk,
            "kategori" => $data->kategori,
            "pekerjaan" => $data->masterPekerjaan->nama,
            "gender" => $data->masterGender->nama,
            "agama" => $data->maseterAgama->nama,
            "suku" => $data->masterSuku->nama,
            "tgl_lahir" => $data->tgl_lahir,
            "pendidikan" => $data->masterPendidikan->nama,
            "alamat" => $data->alamat,
            "rt" => $data->rt,
            "rw" => $data->rw,
            "desa" => $data->id_desa,
            "kecamatan" => $data->id_kecamatan,
            "kabupaten" => $data->id_kabupaten,
            "provinsi" => $data->id_provinsi,
            "kodepos" => $data->kodepos,
            "latitude" => $data->latitude,
            "longtitude" => $data->longtitude,
            "foto_profil" => $data->foto_profil,
            "foto_ktp" => $data->foto_ktp,
            "foto_kk" => $data->foto_kk,
            "gol_darah" => $data->gol_darah,
            "telp" => $data->telp,
            "email" => $data->email,
            "facebook" => $data->facebook,
            "id_user" => $data->id_user,
        ];
    }

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