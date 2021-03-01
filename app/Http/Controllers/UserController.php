<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()){
            return $this->responseError("Invalid Request", $validator->errors());
        }
        $user = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];
        //TODO: Check user people or institution then insert new profil or institution
        $user = User::create($user);
        if ($user) {
            return $this->responseOK("Registrasi sukses", $user);
        } else {
            return $this->responseError("Registrasi gagal", 400);
        }
    }
    
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()){
            return $this->responseError("Invalid Request", $validator->errors());
        }
        $user = User::where('username', $request->username)->first();
        if($user == null) {
            return $this->responseError("Maaf Username atau password salah", null);
        }
        if(Hash::check($request->password, $user->password)){
            $apitoken = md5($user->username) . $this->getToken(128);
            $user->api_token = $apitoken;
            $user->save();
            return $this->responseOK("Login sukses", $user, 201);
        } else {
            return $this->responseError("Maaf Username atau password salah", null);
        }
    }

    public static function getToken($length) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        //$codeAlphabet.= "~!@#$%^&*()_+<>?:;[]{},./";
        $max = strlen($codeAlphabet); // edited
        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }
        return $token;
    }

    public function loginVerify() {
        $user = Auth::user();
        return $this->responseOK("User logged in", $user, 200);
    }

    public function updateUser(Request $request) {
        // $user = User::all();
        // return $this->responseOK("List profil pengguna", $user);
        $user = User::find($request->id);

        if ($request->username != null)
            $user->username = $request->username;
        if ($request->password != null)
            $user->password = Hash::make($request->password);
        if ($request->email != null)
            $user->email = $request->email;
        if ($request->telp != null)
            $user->telp = $request->telp;
        if ($request->id_profil != null)
            $user->id_profil = $request->id_profil;

        $user->save();
        return $this->responseOK("Update user sukses", $user);
    }
}