<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Wilayah extends Model
{
    protected $table = 'wilayah';
    protected $primaryKey = 'id';

    public function scopeCget($query, Request $request) {
        switch ($request->domain) {
            case 'provinsi':
                $query = $query->where('kabupatenkota', 0);
                break;
            case 'kabupatenkota':
                $query = $query->where('kabupatenkota', '!=', 0)->where('kecamatan', 0);
                break;
            case 'kecamatan':
                $query = $query->where('kabupatenkota', '!=', 0)->where('kecamatan', '!=', 0)->where('kelurahan', 0);
                break;
            case 'kelurahan':
                $query = $query->where('kabupatenkota', '!=', 0)->where('kecamatan', '!=', 0)->where('kelurahan', '!=', 0);
                break;
            default:
                return "Destination Error";
        }

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
            
        $query = $query->get();
        return $query;
    }
}