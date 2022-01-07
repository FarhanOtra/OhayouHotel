<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "booking";

    protected $fillable = [
        'date', 'check_in', 'check_out', 'days', 'booking_tipe', 'room_id', 'user_id', 'status'
    ];
}
