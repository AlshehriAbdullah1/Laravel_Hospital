<?php

use App\Models\User;
use App\Models\category;
use Illuminate\Support\Facades\Route;

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

Route::get('/categories/{id}',function (Category $category){
    dd($category);
});

Route::get('/doctors/{id}',function ($id) {
    return view('doctors.index');
});