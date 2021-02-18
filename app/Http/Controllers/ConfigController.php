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
        $master = Master::cget($request);
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
        $wilayah = Wilayah::cget($request);
        return $this->responseOK("Sukses", $wilayah);
    }
}