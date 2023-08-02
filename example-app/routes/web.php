<?php

use App\Models\User;
use App\Models\Booking;
use App\Models\category;
use App\Models\Comment;
use App\Models\Patient;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

Route::post('/register',function(){
    $data = request()->validate([
        'name' => 'required',
        'email' => ['required', 'email', Rule::unique('patients'),Rule::unique('users')],
        'phone'=>'required|min:9|max:10',
        'password' => 'required',
    ]);
    $data['password']=bcrypt($data['password']);
    Patient::create($data);
    auth('patient')->attempt($data);



    
})->middleware('guest');


// for doctors only routes
Route::get('/join', function () {
   return view('doctors.create',[
    'categories'=>Category::get(),
   ]);
})->middleware('guest');

Route::post('/join', function () {
    $data = request()->validate([
        'name' =>'required',
        'email' =>['required',Rule::unique('users','email')],
        'password' => 'required|max:255|min:7',
        'category_id' =>'required',
        'description'=>'required|max:255|min:10',
    ]);
    $data['password']=bcrypt($data['password']);
    User::create($data);
    if(auth()->attempt($data)){
    
        return redirect('/');
    }
    else{
        return redirect('/login');
        
    }
})->middleware('guest');

Route::get('/login', function () {
    return view('login.login');
})->middleware('guest');

Route::post('/login', function () {
    $data = request()->validate([
        'email' =>['required'],
        'password' => 'required',
    ]);
    
   // dd($data);
    if(auth()->attempt($data)){
        session()->regenerate();
        return redirect('/')->with('success','login successfully');
    }else{
        return back()->withInput()->withErrors(['email'=> 'invalid email or password']);
    }
})->middleware('guest');


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
 
    //dd(request()->all());
    $data = request()->validate([
        'full_name' =>'required',
        'email' =>['required'],
        'phone' =>['required','min:9','max:10'],
        'date' =>['required'],
        'datetime_from'=>['required'],
        'datetime_to'=>['required'],
    ]);
    do {
        $tracking_number = Str::random(8);
    } while (Booking::where('tracking_number', $tracking_number)->exists());
    
    // At this point, $tracking_number is unique and can be stored in the database.
    

    
    $data['tracking_number'] =$tracking_number;
    $data['user_id'] =$user->id;
    $data['datetime_from'] = new \DateTime("{$data['date']} {$data['datetime_from']}");
    $data['datetime_to'] = new \DateTime("{$data['date']} {$data['datetime_to']}");
    
    $data['status']='Pending';
    // dd($data);
    if (isset($data['date'])) {
        unset($data['date']);
    }
    $booking =  Booking::create($data);
    return view('components.tracking.track')->with('booking',$booking);
 });

Route::get('/doctors/{id}',function ($id) {
  
    $user =User::select('id','category_id','name','rating')->find($id); 
    // dd($user);
    if($user){
        return view('doctors.index',[
            'doctor'=>User::find($id),
        ]);

    }
    else{
        abort(404);
    }
});




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







 function generateTrackingNumber(){
    $tracking_number = Str::random(8);
    while(Booking::where('tracking_number', $tracking_number)->first() === null){
        $tracking_number = Str::random(8);

    }
    return $tracking_number;

}





