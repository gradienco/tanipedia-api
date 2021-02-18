<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayah';
    protected $primaryKey = 'id';

    public function scopeCget($query, $request) {
        switch ($request->domain) {
            case 'provinsi':
                $query = $query->where();
                break;
            case 'kabupaten':
                $query = $query->where();
                break;
            case 'kecamatan':
                $query = $query->where();
                break;
            case 'desa':
                $query = $query->where();
                break;
            default:
                return "Request Error";
        }
        if ($request->filter != null) {
            foreach ($request->filter as $key => $val) {
                $query = $query->where($key, $val);
            }
        }
        if ($request->order != null) {
            $query = $query->offset(($request->order['limit_page'] *($request->order['page'] - 1)))->limit($request->order['limit_page'])
                    ->orderBy($request->order['order_by'], $request->order['sort']);
        }
        $query = $query->get();
        return $query;
    }
}