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
        $check_out = $request->input('check_out');
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
    public function edit(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'status' => 'required',
        ]);

        $id = $request->id;
        $status = $request->status;

        $booking = Booking::find($id);

        if ($booking) {
            $this->sendNotification($status);

            $booking->status = $status;
         
            $booking->save();

            if($status==1){
                return response()->json(['success' => true,'message' => 'Status Booking Sedang di Proses'],200);
            }
            if($status==2){
                return response()->json(['success' => true,'message' => 'Room Hotel Berhasil Dibooking'],200);
            }
            if($status==3){
                return response()->json(['success' => true,'message' => 'Room Hotel Gagal Dibooking'],200);
            }
       
        } else {
            return response()->json(['success' => false,'message' => 'Booking Tidak Ditemukan!',], 404);
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

    public function sendNotification($status){

    $curl = curl_init();

    if($status==2){
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "to":"/topics/booking",
            "notification": {
                "title": "Booking Kamar Hotel Berhasil",
                "body": "Proses Pemesanan Kamar Hotel Berhasil Dilakukan!"
            }
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: key=AAAAEK5ZbB8:APA91bE4aZAgX35ygRJ5n8R9stVTjhTNMY3l7eS1gCZ1oPbBpWF0aci34dYlnwnP8FuadBnFnx-566MBXkE1GxFL-w2KYjTopQGGSKMJ-1PmLGvZMT3FIO4QorkS_2oT_t9X32Ofgq-H',
            'Content-Type: application/json'
        ),
        ));
    }
    
    if($status==3){
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "to":"/topics/booking",
            "notification": {
                "title": "Booking Kamar Hotel Berhasil",
                "body": "Proses Pemesanan Kamar Hotel Gagal Dilakukan!"
            }
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: key=AAAAEK5ZbB8:APA91bE4aZAgX35ygRJ5n8R9stVTjhTNMY3l7eS1gCZ1oPbBpWF0aci34dYlnwnP8FuadBnFnx-566MBXkE1GxFL-w2KYjTopQGGSKMJ-1PmLGvZMT3FIO4QorkS_2oT_t9X32Ofgq-H',
            'Content-Type: application/json'
        ),
        ));
    }

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

    }

    public function promo(){
        $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "to":"/topics/booking",
        "notification": {
            "title": "Kaget Banget Loh! Promo Awal tahun!",
            "body": "Dapatkan Diskon sampai 30% di Awal Tahun!"
        }
    }',
    CURLOPT_HTTPHEADER => array(
        'Authorization: key=AAAAEK5ZbB8:APA91bE4aZAgX35ygRJ5n8R9stVTjhTNMY3l7eS1gCZ1oPbBpWF0aci34dYlnwnP8FuadBnFnx-566MBXkE1GxFL-w2KYjTopQGGSKMJ-1PmLGvZMT3FIO4QorkS_2oT_t9X32Ofgq-H',
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

    }
    
}
