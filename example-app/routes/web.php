<?php

use App\Models\User;
use App\Models\Booking;
use App\Models\category;
use App\Models\Comment;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\BookingController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   // dd(request('category'));
    return view('index',[
       'doctors'=>User::paginate(10),
       'categories'=>Category::get(),
        ]);
});

Route::get('/category',function (){
    
    $category = Category::find(request('id'));

     return view('index',[
        'doctors'=>User::latest()->where('category_id','=',request('id'))->paginate(10),
        'categories'=>Category::get(),
        'categoryName' => $category->name,
     ]);
});



Route::get('/register',function(){
    return view('register.create');
})->middleware('guest');

Route::post('/register',[RegisterController::class, 'create'])->middleware('guest');


// for doctors only routes
Route::get('/join', function () {
   return view('doctors.create',[
    'categories'=>Category::get(),
   ]);
})->middleware('guest');

Route::post('/join', [DoctorSessionController::class, 'store'])->middleware('guest'); 
   

Route::get('/login', function () {
    return view('login.login');
})->name('login')->middleware('guest');

Route::post('/login', function () {
    $data = request()->validate([
        'email' => 'required|email',
        'password' => ['required'],
    ]);

    if (auth('patient')->attempt($data)) {
       // dd("patient");
        // Authentication success
        return redirect('/'); // Replace with the desired redirect URL after login
    }
    elseif(auth()->attempt($data)){
       // dd("default login");
        return redirect('/'); // Replace with the desired redirect URL after login
    } else {
        // Authentication failed
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }
});

Route::post('/logout',function (){
        auth('patient')->logout();
        auth()->logout();
        return redirect('/login');

});
Route::get('/search',function (){

    if(request('search')==null ||strlen(request('search'))==0){
     return redirect('/');
    }
     $doctors = User::latest()->where('name','like','%'.request('search').'%');
     return view('index',[
         'doctors'=>$doctors->paginate(10),
         'categories'=>Category::get(),
     ]);
 });




 //booking 

 Route::post('/booking/{id}',[BookingController::class, 'create'])->middleware('auth:patient');;

Route::get('/doctors/{id}',function ($id) {
  
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
})->middleware('auth:patient');




Route::post('/doctor/comment/{id}', function (Request $request, $id) {
    $user = User::find($id);

    if ($user === null) {
        abort(404);
    }

  
    $data = $request->validate([
        'title' => 'required',
        'body' => 'required',
        'rating' => 'required|numeric|min:1|max:5',
        'name'=>'nullable',
    ]);  
    
    
    $data['user_id'] = $user->id;
    if($data['name'] == null){
        $data['name'] = 'Anonymous';
    }
    
     Comment::create($data);
     return redirect()->back();



    
});



Route::get('/bookings/tracking', function () {

    // dd(request()->all());
    if(request('id') == null){
        $booking= Booking::where('patient_id','=',Auth::guard('patient')->user()->id)->latest()->paginate(5);
        return view('components.tracking.track',);
    }
    $booking = Booking::where('tracking_number', request('id'))->first();
    if ($booking === null) {
        abort(404);
    }
    else{
        
    }

    $formattedDatetimeFrom = Carbon::parse($booking->datetime_from)->format('d M, Y');
    $formattedTimeFrom = Carbon::parse($booking->datetime_from)->format('h:iA');
    $formattedTimeTo = Carbon::parse($booking->datetime_to)->format('h:iA');


    $data = [
        'name' => $booking->patient->name,
        'phone' => $booking->patient->phone,
      'status' => $booking->status,
      'email'=> $booking->patient->email,
      'tracking_number'=> $booking->tracking_number,
      'date'=> $formattedDatetimeFrom,
      'datetime_from'=> $formattedTimeFrom,
      'datetime_to'=> $formattedTimeTo, 
    ];

    
    return view('components.tracking.track',)->with('booking', $data);



})->middleware('auth:patient');





Route::get('bookings/all',function(){
    // dd(auth('web')->user()->id);

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
})->middleware('auth:web');


Route::post('/bookings/suspend/{id}',[BookingController::class,'suspend']);
Route::post('/bookings/complete/{id}',[BookingController::class,'complete']);













