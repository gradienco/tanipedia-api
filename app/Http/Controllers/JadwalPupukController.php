<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\JadwalPupuk;


class JadwalPupukController extends Controller
{
    public function getJadwalPupuk(Request $request) {
        $jadwalPupuk = JadwalPupuk::cget($request);
        return $this->responseOK("List jadwal pupuk", $jadwalPupuk);
    }

    public function detailJadwalPupuk(Request $request) {
        $jadwalPupuk = JadwalPupuk::find($request->id);
        $jadwalPupuk = JadwalPupuk::mapData($jadwalPupuk);
        return $this->responseOK("Detail jadwal pupuk", $jadwalPupuk);
    }

    public function insertJadwalPupuk(Request $request) {
        $validator = Validator::make($request->all(), [
            'tgl_distribusi'  => 'required',
        ]);
        if ($validator->fails()){
            return $this->responseError("Invalid Request", $validator->errors());
        }
        $jadwalPupuk = JadwalPupuk::create($request->all());
        $jadwalPupuk = JadwalPupuk::mapData($jadwalPupuk);
        return $this->responseOK("Tambah jadwal pupuk sukses", $jadwalPupuk);
    }

    public function updateJadwalPupuk(Request $request) {
        $jadwalPupuk = JadwalPupuk::find($request->id);
        $jadwalPupuk->jenis_pupuk = $request->jenis_pupuk;
        $jadwalPupuk->kapasitas = $request->kapasitas;
        $jadwalPupuk->satuan = $request->satuan;
        $jadwalPupuk->id_poktan = $request->id_poktan;
        $jadwalPupuk->tgl_distribusi = $request->tgl_distribusi;
        $jadwalPupuk->id_instansi = $request->id_instansi;
        $jadwalPupuk->keterangan = $request->keterangan;
        $jadwalPupuk->save();
        $jadwalPupuk = JadwalPupuk::mapData($jadwalPupuk);
        return $this->responseOK("Update jadwal pupuk sukses", $jadwalPupuk);
    }

    public function deleteJadwalPupuk(Request $request) {
        $jadwalPupuk = JadwalPupuk::find($request->id);
        if ($jadwalPupuk) {
            $jadwalPupuk->delete();
            return $this->responseOK("Hapus jadwal pupuk sukses", null);
        } else {
            return $this->responseError("Jadwal pupuk tidak ada");
        }
    }
}