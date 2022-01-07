<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'nama' => 'required',
            'nik' => 'required|unique:users',
            'no_telepon' => 'required'
        ]);
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $nama = $request->input('nama');
        $nik = $request->input('nik');
        $no_telepon = $request->input('no_telepon');

        $user = User::create([
            'email' => $email,
            'password' => $password,
            'nama' => $nama,
            'nik' => $nik,
            'no_telepon' => $no_telepon
        ]);

        return response()->json(['message' => 'Pendaftaran pengguna berhasil dilaksanakan']);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'Login failed'], 401);
        }

        $isValidPassword = Hash::check($password, $user->password);
        if (!$isValidPassword) {
            return response()->json(['message' => 'Login failed'], 401);
        }

        $credentials = $request->only(['email', 'password']);

        $token = Auth::attempt($credentials);

        if(!$token){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // $generateToken = bin2hex(random_bytes(40));
        $user->update([
            'token' => $token
        ]);
        // return response()->json($user);
        return response()->json([
            'data' => $user,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ],200); 
    }

    public function logout(){
        $user = \Auth::user();
        $user->token = null;
        $user->save();

        return response()->json(['message' => 'Pengguna telah logout']);
    }
}