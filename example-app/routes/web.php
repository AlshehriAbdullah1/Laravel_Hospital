<?php

use App\Models\User;
use App\Models\Booking;
use App\Models\category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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


Route::get('/register', function () {
   return view('register.create',[
    'categories'=>Category::get(),
   ]);
})->middleware('guest');

Route::post('/register', function () {
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

 Route::post('/booking/{user_id}',function (User $user){
    if(!($user->id !=null && Rule::exists('users','user_id'))){
        abort(404);
    }
    
    $data = request()->validate([
        'name' =>'required',
        'email' =>['required'],
        'phone' =>['required'],
        'datetime_from'=>['required',],
        'datetime_to'=>['required',],
    ]);
   $data['status']='Pending';
    Booking::create($data);
    return redirect('/')->with('success','booking successfully');
 });

Route::get('/doctors/{id}',function ($id) {
    return view('doctors.index');
});


