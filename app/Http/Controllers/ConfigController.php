<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Master;

class ConfigController extends Controller
{
    public function getMaster(Request $request) {
        $master = Master::all();
        return $this->responseOK("List data master", $master);
    }
}