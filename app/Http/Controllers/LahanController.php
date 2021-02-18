<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Lahan;

class LahanController extends Controller
{
    public function getLahan(Request $request) {
        $lahan = Lahan::cget($request);
        return $this->responseOK("List lahan pertanian", $lahan);
    }

    public function detailLahan(Request $request) {
        $lahan = Lahan::find($request->id);
        $lahan = Lahan::mapData($lahan);
        return $this->responseOK("Lahan pertanian", $lahan);
    }

    public function insertLahan(Request $request) {
        $validator = Validator::make($request->all(), [
            'luas'      => 'required',
        ]);
        if ($validator->fails()){
            return $this->responseError("Invalid Request", $validator->errors());
        }
        $lahan = Lahan::create($request->all());
        $lahan = Lahan::mapData($lahan);
        return $this->responseOK("Tambah lahan sukses", $lahan);
    }

    public function updateLahan(Request $request) {
        $lahan = Lahan::find($request->id);

        $lahan->kategori = $request->kategori;
        $lahan->luas = $request->luas;
        $lahan->satuan = $request->satuan;
        $lahan->alamat = $request->alamat;
        $lahan->usia_tanam = $request->usia_tanam;
        $lahan->id_petani = $request->id_petani;
        $lahan->id_instansi = $request->id_instansi;
        $lahan->id_desa = $request->id_desa;
        $lahan->id_kecamatan = $request->id_kecamatan;
        $lahan->id_kabupaten = $request->id_kabupaten;
        $lahan->id_provinsi = $request->id_provinsi;
        $lahan->latitude = $request->latitude;
        $lahan->longtitude = $request->longtitude;
        $lahan->keterangan = $request->keterangan;
        
        $lahan->save();
        $lahan = Lahan::mapData($lahan);
        return $this->responseOK("Update lahan sukses", $lahan);
    }

    public function deleteLahan(Request $request) {
        $lahan = Lahan::find($request->id);
        if ($lahan) {
            $lahan->delete();
            return $this->responseOK("Hapus lahan sukses", null);
        } else {
            return $this->responseError("Lahan tidak ada");
        }
    }
}