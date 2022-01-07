<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Booking;
use DB;

class BookingController extends Controller
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'days' => 'required',
            'booking_tipe' => 'required',
            'room_id' => 'required'
        ]);

        $date = Carbon::now()->toDateString();
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_in');
        $days = $request->input('days');
        $booking_tipe = $request->input('booking_tipe');
        $room_id = $request->input('room_id');
        $user_id = auth('api')->user()->id;

        $booking = Booking::create([
            'date' => $date,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'days' => $days,
            'booking_tipe' => $booking_tipe,
            'room_id' => $room_id,
            'user_id' => $user_id,
            'status' => 1
        ]);

        return response()->json(['success' => true,'message' => 'Proses Booking Berhasil'],200);
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
