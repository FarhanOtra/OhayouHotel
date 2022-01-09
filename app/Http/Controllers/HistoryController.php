<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Booking;
use DB;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth('api')->user()->id;
        $post = DB::select("SELECT booking.id as booking_id, booking.date as date, booking.check_in as check_in, booking.check_out as check_out, booking.days as days, booking.status as status, booking.booking_tipe as booking_tipe, users.nama as username, hotel_room.nomor as nomor_room, tipe_room.tipe as tipe_room, tipe_room.harga as harga_room, tipe_room.imageurl as imageurl FROM booking join hotel_room on booking.room_id=hotel_room.id join tipe_room on hotel_room.tipe_id=tipe_room.id join users on booking.user_id=users.id WHERE booking.user_id=? ORDER BY booking.created_at DESC;", [$user_id]);
        if ($post) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail History Booking!',
                'history'   => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'History Tidak Ditemukan!',
            ], 404);
        }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
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
