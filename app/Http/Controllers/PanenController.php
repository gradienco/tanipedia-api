<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Panen;

class PanenController extends Controller
{
    public function getPanen(Request $request) {
        $panen = Panen::all();
        return $this->responseOK("List panen pertanian", $panen);
    }

    public function detailpanen(Request $request) {
        $panen = Panen::find($request->id);
        return $this->responseOK("Panen pertanian", $panen);
    }

    public function insertPanen(Request $request) {
        $validator = Validator::make($request->all(), [
            'total_panen'      => 'required',
        ]);
        if ($validator->fails()){
            return $this->responseError("Invalid Request", $validator->errors());
        }
        $panen = Panen::create($request->all());
        return $this->responseOK("Tambah panen sukses", $panen);
    }

    public function updatePanen(Request $request) {
        $panen = Panen::find($request->id);

        $panen->id_petani = $request->id_petani;
        $panen->id_instansi = $request->id_instansi;
        $panen->kategori = $request->kategori;
        $panen->varietas = $request->varietas;
        $panen->total_panen = $request->total_panen;
        $panen->satuan = $request->satuan;
        $panen->tgl_tanam = $request->tgl_tanam;
        $panen->tgl_panen = $request->tgl_panen;
        $panen->id_lahan = $request->id_lahan;
        $panen->keterangan = $request->keterangan;
        
        $panen->save();
        return $this->responseOK("Update panen sukses", $panen);
    }

    public function deletePanen(Request $request) {
        $panen = Panen::find($request->id);
        if ($panen) {
            $panen->delete();
            return $this->responseOK("Hapus panen sukses", null);
        } else {
            return $this->responseError("Panen tidak ada");
        }
    }
}