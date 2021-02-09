<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Profil;

class ProfilController extends Controller
{
    public function getProfil(Request $request) {
        $profil = Profil::all();
        return $this->responseOK("List profil pengguna", $profil);
    }

    public function detailProfil(Request $request) {
        $profil = Profil::find($request->id);
        return $this->responseOK("Profil pengguna", $profil);
    }

    public function insertProfil(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            // 'id_user' => 'unique:profil',
        ]);
        if ($validator->fails()){
            return $this->responseError("Invalid Request", $validator->errors());
        }
        $profil = Profil::create($request->all());
        return $this->responseOK("Tambah profil sukses", $profil);
    }

    public function updateProfil(Request $request) {
        $profil = Profil::find($request->id);
        $profil->nama = $request->nama;
        $profil->nik = $request->nik;
        $profil->kk = $request->kk;
        $profil->kategori = $request->kategori;
        $profil->pekerjaan = $request->pekerjaan;
        $profil->gender = $request->gender;
        $profil->agama = $request->agama;
        $profil->suku = $request->suku;
        $profil->tgl_lahir = $request->tgl_lahir;
        $profil->pendidikan = $request->pendidikan;
        $profil->alamat = $request->alamat;
        $profil->rt = $request->rt;
        $profil->rw = $request->rw;
        $profil->id_desa = $request->id_desa;
        $profil->id_kecamatan = $request->id_kecamatan;
        $profil->id_kabupaten = $request->id_kabupaten;
        $profil->id_provinsi = $request->id_provinsi;
        $profil->kodepos = $request->kodepos;
        $profil->latitude = $request->latitude;
        $profil->longtitude = $request->longtitude;
        $profil->foto_profil = $request->foto_profil;
        $profil->foto_ktp = $request->foto_ktp;
        $profil->foto_kk = $request->foto_kk;
        $profil->gol_darah = $request->gol_darah;
        $profil->telp = $request->telp;
        $profil->email = $request->email;
        $profil->facebook = $request->facebook;
        $profil->id_user = $request->id_user;
        $profil->save();
        return $this->responseOK("Update profil sukses", $profil);
    }

    public function deleteProfil(Request $request) {
        $profil = Profil::find($request->id);
        $profil->delete();
        return $this->responseOK("Hapus profil sukses", null);
    }
}