<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Profil;

class ProfilController extends Controller
{
    public function getProfil(Request $request) {
        $profil = Profil::cget($request);
        return $this->responseOK("List profil pengguna", $profil);
    }

    public function detailProfil(Request $request) {
        $profil = Profil::find($request->id);
        $profil = Profil::mapData($profil);
        return $this->responseOK("Profil pengguna", $profil);
    }

    public function insertProfil(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'id_user'   => 'unique:profil',
        ]);
        if ($validator->fails()){
            return $this->responseError("Invalid Request", $validator->errors());
        }
        $profil = Profil::create($request->all());
        $profil = Profil::mapData($profil);
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
        $profil->gol_darah = $request->gol_darah;
        $profil->telp = $request->telp;
        $profil->email = $request->email;
        $profil->facebook = $request->facebook;
        $profil->id_user = $request->id_user;

        //Upload Image
        if($request->foto_profil != null) 
            $profil->foto_profil = $this->uploadImage($request->foto_profil, "profil", $profil->foto_profil);
        if($request->foto_ktp != null) 
            $profil->foto_ktp = $this->uploadImage($request->foto_ktp, "profil", $profil->foto_profil);
        if($request->foto_kk != null) 
            $profil->foto_kk = $this->uploadImage($request->foto_kk, "profil", $profil->foto_profil);

        $profil->save();
        $profil = Profil::mapData($profil);
        return $this->responseOK("Update profil sukses", $profil);
    }

    public function deleteProfil(Request $request) {
        $profil = Profil::find($request->id);
        if ($profil) {
            foreach ($profil->hasUser as $user)
                $user->delete();
            $profil->delete();
            return $this->responseOK("Hapus profil sukses", null);
        } else {
            return $this->responseError("Profil tidak ada");
        }
    }

    public function updateImage (Request $request) {
        $profil = Profil::find($request->id);
        if($request->foto_profil != null) 
            $profil->foto_profil = $this->uploadImage($request->foto_profil, "profil", $profil->foto_profil);
        if($request->foto_ktp != null) 
            $profil->foto_ktp = $this->uploadImage($request->foto_ktp, "profil", $profil->foto_ktp);
        if($request->foto_kk != null) 
            $profil->foto_kk = $this->uploadImage($request->foto_kk, "profil", $profil->foto_kk);
        $profil->save();
        $profil = Profil::mapData($profil);
        return $this->responseOK("Update foto sukses", $profil);
    }
}