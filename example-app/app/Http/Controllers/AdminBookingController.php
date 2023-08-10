<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminBookingController extends Controller
{
    public function index(){
        $bookings = User::find(auth('web')->user()->id)->bookings;

        $modifiedBookings = $bookings->map(function ($booking) {
            $formattedDatetimeFrom = Carbon::parse($booking->datetime_from)->format('d M, Y');
            $formattedTimeFrom = Carbon::parse($booking->datetime_from)->format('h:iA');
            $formattedTimeTo = Carbon::parse($booking->datetime_to)->format('h:iA');
        
            return [
                'id'=>$booking->id,
                'name' => $booking->patient->name,
                'phone' => $booking->patient->phone,
                'status' => $booking->status,
                'email' => $booking->patient->email,
                'tracking_number' => $booking->tracking_number,
                'date' => $formattedDatetimeFrom,
                'datetime_from' => $formattedTimeFrom,
                'datetime_to' => $formattedTimeTo,
            ];
        });
        
            // dd(auth()->user());
        return view('components.doctors.track',[
            'bookings'=>$modifiedBookings
        ]);

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
