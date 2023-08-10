<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class BookingController extends Controller
{
    public function index($id){

        $user =User::select('id','category_id','name','rating')->find($id); 
        // dd($user);
        $patient = Auth::guard('patient')->user();
        //dd($patient);
        if($user){
            return view('doctors.index',[
                'doctor'=>User::find($id),
                'patient'=>$patient,
            ]);
    
        }
        else{
            abort(404);
        }

    }



    public function patient_track(Request $request){
        $trackingNumber = $request->query('id');
        if($trackingNumber){
            $bookings=Patient::find(auth('patient')->user()->id)->bookings->where('tracking_number', '==', $trackingNumber);
        }   
        else{
        $bookings = Patient::find(auth('patient')->user()->id)->bookings()
        ->orderBy('created_at', 'desc')
        ->get();
        }
    $modifiedBookings = $bookings->map(function ($booking) {
        $formattedDatetimeFrom = Carbon::parse($booking->datetime_from)->format('d M, Y');
        $formattedTimeFrom = Carbon::parse($booking->datetime_from)->format('h:iA');
        $formattedTimeTo = Carbon::parse($booking->datetime_to)->format('h:iA');
    
        return [
            
            'id'=>$booking->user->id,
            'name' => $booking->user->name,
            'phone' => $booking->user->phone,
            'status' => $booking->status,
            'email' => $booking->user->email,
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


   


public function create(Request $request){
    $user=User::find($request->id);
    if(($user ==null || ! Rule::exists('users','user_id'))){
        abort(404);
    }

    $data = $request->validate([

        'date' =>['required'],
        'datetime_from'=>['required'],
        'datetime_to'=>['required'],
    ]);
    $data['datetime_from'] = new \DateTime("{$data['date']} {$data['datetime_from']}");
    $data['datetime_to'] = new \DateTime("{$data['date']} {$data['datetime_to']}");
    $data['datetime_from'] = Carbon::parse($data['datetime_from'])->format('Y-m-d H:i:s');
    $data['datetime_to'] = Carbon::parse($data['datetime_to'])->format('Y-m-d H:i:s');
    if ($this->checkConflict($user->id, $data['datetime_from'], $data['datetime_to'])) {
        return back()->withErrors(['conflict' => 'Selected time conflicts with existing bookings. Please select another time or date']);
    }
    do {
        $tracking_number = Str::random(8);
    } while (Booking::where('tracking_number', $tracking_number)->exists());
    $data['tracking_number'] =$tracking_number;
    $data['user_id'] =$user->id;
    $data['status']='Pending';
    $data['patient_id']=auth('patient')->user()->id?? 'Undefined';
    if (isset($data['date'])) {
        unset($data['date']);
    }
   $booking =  Booking::create($data);
        return redirect('/bookings?id=' . $booking->tracking_number);

    
}


private function checkConflict($userId, $datetimeFrom, $datetimeTo)
{
    return Booking::where('user_id', $userId)
        ->where(function ($query) use ($datetimeFrom, $datetimeTo) {
            $query->whereBetween('datetime_from', [$datetimeFrom, $datetimeTo])
                ->orWhereBetween('datetime_to', [$datetimeFrom, $datetimeTo])
                ->orWhere(function ($q) use ($datetimeFrom, $datetimeTo) {
                    $q->where('datetime_from', '<', $datetimeFrom)
                        ->where('datetime_to', '>', $datetimeTo);
                });
        })
        ->exists();
}







}
