<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Auth;
use Illuminate\Support\Facades\File;

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

    public function responseError($message = null, $data = null, $responseCode = 400) {
        $attribue = [
            "status"    => "ERROR",
            "message"   => $message,
            "data"      => $data
        ];
        return response()->json($attribue);
    }

    public function fcm($devicesId, $data, $notif) {
        $fields = array(
            'registration_ids' => $devicesId,
            'data' => $data,
            'notification' => $notif
        );

        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            "Authorization: key=" . env("FCM_SERVER_KEY"),
            "Content-Type: application/json"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);

        return $result;
    }

    public function convertImage($baseImage, $head = "image", $previous = null) {
        $baseImage = str_replace('data:image/png;base64,', '', $baseImage);
        $baseImage = str_replace(' ', '+', $baseImage);
        $imageName = $head.'-'.Auth::user()->id.'-'.time().'.'.'png';
        if(!File::exists(base_path() . '/public/upload/')) {
            File::makeDirectory(base_path() . '/public/upload/');
        }
        if(!File::exists(base_path() . '/public/upload/image/')) {
            File::makeDirectory(base_path() . '/public/upload/image/');
        }
        File::put(base_path() . '/public/upload/image/' . $imageName, base64_decode($baseImage));
        $imageName = '/public/upload/image/' . $imageName;

        //Delete previous photo
        if ($previous != null)
            File::delete(base_path() . $previous);
        return $imageName;
    }
}