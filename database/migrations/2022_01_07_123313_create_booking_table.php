<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->date('check_in');
            $table->date('check_out');
            $table->Integer('days');
            $table->Integer('booking_tipe');
            $table->Integer('room_id')->reference('id')->on('hotel_room');
            $table->Integer('user_id')->reference('id')->on('users');
            $table->Integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking');
    }
}
