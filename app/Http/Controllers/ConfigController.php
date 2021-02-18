<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Master;
use App\Models\Attachment;
use App\Models\Wilayah;

class ConfigController extends Controller
{
    public function getMaster(Request $request) {
        $master = Master::all();
        return $this->responseOK("List data master", $master);
    }

    public function insertAttachment(Request $request) {
        //TODO
        //Check file type
        //Upload file
        //Create new Attachment
        //Relation Table
        return $this->responseOK("Insert new attachment", $attachment);
    }

    public function deleteAttachment(Request $request) {
        File::delete(base_path() . $request->url);
        //TODO
        //Unlink relation
        return $this->responseOK("Delete attachment success");
    }

    public function getWilayah(Request $request) {
        switch ($request->domain) {
            case 'provinsi':
                $wilayah = Wilayah::all();
                break;
            case 'kabupaten':
                $wilayah = Wilayah::all();
                break;
            case 'kecamatan':
                $wilayah = Wilayah::all();
                break;
            case 'desa':
                $wilayah = Wilayah::all();
                break;
            default:
                return $this->responseError("Request Error");
        }
        return $this->responseOK("Sukses");
    }
}