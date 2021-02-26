<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Master extends Model
{
    use SoftDeletes;
    
    protected $table = 'set_master';
    protected $primaryKey = 'id';

    public function scopeCget($query, $request) {
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