<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $user_id = auth('api')->user()->id;

        $this->validate($request, [
            'passwordlama' => 'required',
            'passwordbaru' => 'required|min:6',
            'passwordconf' => 'required|min:6'
        ]);

            $user = User::find($user_id);

            if ($user) {
            $isValidPassword = Hash::check($request->passwordlama, $user->password);
                if (!$isValidPassword) {
                    return response()->json(['message' => 'Password Lama Salah'], 401);
                }else{
                    if($request->passwordbaru==$request->passwordconf){
                        $user->password = Hash::make($request->passwordbaru) ;
                    }else{
                        return response()->json(['message' => 'Password Baru Tidak Sama'], 401);
                    }
                }
                $user->save();
        
                return response()->json([
                    'success'   => true,
                    'message'   => 'Berhasil Merubah Password'
                ], 200);

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Tidak Ditemukan!',
                ], 404);
            }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_id = auth('api')->user()->id;

        $user = User::find($user_id);

        if ($user) {
            return response()->json([
                'success'   => true,
                'message'   => 'Berhasil Mengambil Data',
                'editprofile' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Ditemukan!',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user_id = auth('api')->user()->id;

        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$user_id,
            'nama' => 'required',
            'nik' => 'required|unique:users,nik,'.$user_id,
            'no_telepon' => 'required'
        ]);
        
        
        $user = User::find($user_id);

        if ($user) {
            $user->email = $request->email ? $request->email : $user->email  ;
            $user->nama = $request->nama ? $request->nama: $user->nama  ;
            $user->nik = $request->nik ? $request->nik: $user->nik  ;
            $user->no_telepon = $request->no_telepon ? $request->no_telepon : $user->no_telepon  ;

            $user->save();
    
            return response()->json([
                'success'   => true,
                'message'   => 'Data Sudah di Update',
                'editprofile' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Ditemukan!',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
