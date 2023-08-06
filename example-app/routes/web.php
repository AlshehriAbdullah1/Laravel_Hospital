<?php

use App\Models\User;
use App\Models\Booking;
use App\Models\category;
use App\Models\Comment;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DoctorController;
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
        'password' => 'required',
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
        dd('Authentication failed!!. ');
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

 Route::post('/booking/{id}',function (User $user){  
    $user=User::find(request('id'));
    if(($user ==null || ! Rule::exists('users','user_id'))){
        abort(404);
    }
 
    dd(request()->all());
    $data = request()->validate([

        'date' =>['required'],
        'datetime_from'=>['required'],
        'datetime_to'=>['required'],
    ]);
    do {
        $tracking_number = Str::random(8);
    } while (Booking::where('tracking_number', $tracking_number)->exists());
    
    // At this point, $tracking_number is unique and can be stored in the database.
   // dd(Auth::guard('patient')->user());
    if(Auth::check()){
        $loggedInUserId=Auth::user()->user_id;
    }

    
    $data['tracking_number'] =$tracking_number;
    $data['user_id'] =$user->id;
    $data['datetime_from'] = new \DateTime("{$data['date']} {$data['datetime_from']}");
    $data['datetime_to'] = new \DateTime("{$data['date']} {$data['datetime_to']}");
    
    $data['status']='Pending';
    
    if (isset($data['date'])) {
        unset($data['date']);
    }
     dd($data);
   // $booking =  Booking::create($data);
    //return view('components.tracking.track')->with('booking',$booking);
 });

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



Route::get('/bookings/track', function () {



    return view('components.tracking.track',);



});












