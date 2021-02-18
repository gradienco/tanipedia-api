<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Master extends Model
{
    use SoftDeletes;
    
    protected $table = 'set_master';
    protected $primaryKey = 'id';

    public static function mapData($data) {
        return [
            "id" => $data->id,
            "mastertype" => $data->masterType->nama,
            "nama" => $data->nama,
            "deskripsi" => $data->deskripsi,
            "parent_id" => $data->parent_id
        ];
    }

    public function masterType() {
        return $this->belongsTo('App\Models\MasterType', 'id_mastertype')->withDefault();
    }

}