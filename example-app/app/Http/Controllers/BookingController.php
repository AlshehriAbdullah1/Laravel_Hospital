<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){

        

    }


    public function suspend($id)
{
    $booking = Booking::find($id);
    if ($booking && $booking->status != 'Suspended' ) {

        $booking->status = 'Suspended';
        $booking->save();
    }

    return back();
}

public function complete($id)
{
    $booking = Booking::find($id);
    if ($booking && $booking->status != 'Completed') {
        $booking->status = 'Completed';
        $booking->save();
    }

    return back();
}

}
