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
        'jenis_pupuk', 'kapasitas', 'satuan', 'id_poktan', 'tgl_distribusi', 'id_instansi', 'keterangan'
    ];

    public static function mapData($data) {
        return [
            "id" => $data->id,
            "jenis_pupuk" => $data->jenis_pupuk,
            "kapasitas" => $data->kapasitas,
            "satuan" => $data->masterSatuan->nama,
            "id_poktan" => $data->id_poktan,
            "poktan" => $data->poktan,
            "id_petani" => $data->id_petani,
            "petani" => $data->petani,
            "tgl_distribusi" => $data->tgl_distribusi,
            "instansi" => $data->instansi,
            "keterangan" => $data->keterangan,
        ];
    }

    public function masterSatuan() {
        return $this->belongsTo('App\Models\Master', 'satuan')->withDefault();
    }
}