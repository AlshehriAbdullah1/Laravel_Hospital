<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class SessionController extends Controller
{
    public function index(){

        return view('login.login');


    }

        public function destroy(){
            auth('patient')->logout();
            auth()->logout();
            return redirect('/login');

        }

        public function store(){
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

        }

        public function search (){

            if(request('search')==null ||strlen(request('search'))==0){
                return redirect('/');
               }
                $doctors = User::latest()->where('name','like','%'.request('search').'%');
                return view('index',[
                    'doctors'=>$doctors->paginate(10),
                    'categories'=>Category::get(),
                ]);
        }

        public function category(){

            $category = Category::find(request('id'));

            return view('index',[
               'doctors'=>User::latest()->where('category_id','=',request('id'))->paginate(10),
               'categories'=>Category::get(),
               'categoryName' => $category->name,
            ]);
        }
    
}
