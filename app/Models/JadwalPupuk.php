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