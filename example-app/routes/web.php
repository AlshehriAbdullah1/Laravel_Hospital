<?php

use App\Models\User;
// use App\Models\Booking;
use App\Models\category;
// use App\Models\Comment;
use App\Http\Controllers\RegisterController;
// use App\Http\Controllers\DoctorController;
use App\Http\Controllers\BookingController;
// use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\DoctorSessionController;
use App\Http\Controllers\SessionController;
// use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Auth;
// use Carbon\Carbon;


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
    return view('index',[
       'doctors'=>User::paginate(10),
       'categories'=>Category::get(),
        ]);
});

Route::get('/category',[SessionController::class,'category']);



Route::get('/register',[RegisterController::class,'index'])->middleware('guest');

Route::post('/register',[RegisterController::class, 'create'])->middleware('guest');


// for doctors only routes
Route::get('/join',[DoctorSessionController::class,'index'])->middleware('guest');

Route::post('/join', [DoctorSessionController::class, 'store'])->middleware('guest'); 
   

Route::get('/login',[SessionController::class,'index'])->name('login')->middleware('guest');
Route::get('/login',[SessionController::class,'index'])->middleware('guest');

Route::post('/login', [SessionController::class,'store']);

Route::post('/logout',[SessionController::class,'destroy']);
Route::get('/search',[SessionController::class,'search']);

 //booking 

 Route::post('/booking/{id}',[BookingController::class, 'create'])->middleware('auth:patient');;

Route::get('/doctors/{id}',[BookingController::class,'index'])->middleware('auth:patient');




Route::post('/doctor/comment/{id}', [BookingController::class,'create']);



Route::get('/bookings', [BookingController::class, 'patient_track'])->middleware('auth:patient');
Route::get('/bookings/all',[AdminBookingController::class,'index'])->middleware('auth:web');



// Route::get('/bookings');
Route::post('/bookings/suspend/{id}',[AdminBookingController::class,'suspend'])->middleware("auth:web");
Route::post('/bookings/complete/{id}',[AdminBookingController::class,'complete'])->middleware("auth:web");













