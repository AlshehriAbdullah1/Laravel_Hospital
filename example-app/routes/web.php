<?php

use App\Models\User;
use App\Models\category;
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
    //dd($category->name);
    // dd($category);
     return view('index',[
        'doctors'=>User::latest()->where('category_id','=',request('id'))->paginate(10),
        'categories'=>Category::get(),
        'categoryName' => $category->name,
     ]);
});
Route::get('/search',function (){
   // dd(request('search'));
   // dd(request('search'));
   if(request('search')==null ||strlen(request('search'))==0){
    return redirect('/');
   }
    $doctors = User::latest()->where('name','like','%'.request('search').'%');
   
    //dd($doctors);
    return view('index',[
        'doctors'=>$doctors->paginate(10),
        'categories'=>Category::get(),
    ]);
});



Route::get('/doctors/{id}',function ($id) {
    return view('doctors.index');
});