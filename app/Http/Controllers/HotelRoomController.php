<?php

namespace App\Http\Controllers;

use App\Models\HotelRoom;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class HotelRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotelroom = DB::select("SELECT hotel_room.id, hotel_room.nomor, tipe_room.tipe, tipe_room.harga, tipe_room.deskripsi, tipe_room.kapasitas, tipe_room.imageurl FROM hotel_room join tipe_room on hotel_room.tipe_id=tipe_room.id;");
        $response = new \stdClass();
        $response->tanggal = Carbon::now()->toDateString();
        $response->hotelroom = $hotelroom;
        return response()->json($response);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailroom = DB::select("SELECT hotel_room.id, hotel_room.nomor, tipe_room.tipe, tipe_room.harga, tipe_room.deskripsi, tipe_room.kapasitas, tipe_room.imageurl FROM hotel_room join tipe_room on hotel_room.tipe_id=tipe_room.id WHERE hotel_room.id=?",[$id]);
        $response = new \stdClass();
        $response->tanggal = Carbon::now()->toDateString();
        $response->detail_room = $detail_room;
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
