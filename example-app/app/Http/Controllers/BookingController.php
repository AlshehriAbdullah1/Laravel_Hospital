<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class BookingController extends Controller
{
    public function index(){

        

    }



    public function patient_track(){

        $bookings = Patient::find(auth('patient')->user()->id)->bookings;

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



        // the track file should look like the one on the doctor's page , except suspend,complete 
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


public function create(Request $request){

    $user=User::find($request->id);
    if(($user ==null || ! Rule::exists('users','user_id'))){
        abort(404);
    }
 
    // dd(request()->all());
    $data = $request->validate([

        'date' =>['required'],
        'datetime_from'=>['required'],
        'datetime_to'=>['required'],
    ]);
    do {
        $tracking_number = Str::random(8);
    } while (Booking::where('tracking_number', $tracking_number)->exists());
    
  //  dd(request()->all());
    // At this point, $tracking_number is unique and can be stored in the database.
   // dd(Auth::guard('patient')->user());
    $data['tracking_number'] =$tracking_number;
    $data['user_id'] =$user->id;
    $data['datetime_from'] = new \DateTime("{$data['date']} {$data['datetime_from']}");
    $data['datetime_to'] = new \DateTime("{$data['date']} {$data['datetime_to']}");
    $data['datetime_from'] = Carbon::parse($data['datetime_from'])->format('Y-m-d H:i:s');
    $data['datetime_to'] = Carbon::parse($data['datetime_to'])->format('Y-m-d H:i:s');
    $data['status']='Pending';
    $data['patient_id']=auth('patient')->user()->id?? 'Undefined';
    if (isset($data['date'])) {
        unset($data['date']);
    }
   $booking =  Booking::create($data);
        
        return redirect('/bookings/tracking?id=' . $booking->tracking_number);

    
}

}
