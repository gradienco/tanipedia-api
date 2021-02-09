<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function responseOK($message = null, $data = null, $responseCode = 200) {
        $attribue = [
            "status"    => "OK",
            "message"   => $message,
            "data"      => $data
        ];
        return response()->json($attribue, $responseCode);
    }

    public function responseError($message = null, $data, $responseCode = 400) {
        $attribue = [
            "status"    => "ERROR",
            "message"   => $message,
            "data"      => $data
        ];
        return response()->json($attribue);
    }
}
