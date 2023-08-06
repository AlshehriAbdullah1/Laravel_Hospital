<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoctorSessionController extends Controller
{
    public function index(){


        
    }
    public function create(){

    }

    public function store(Request $request){
        $data = $request()->validate([
            'name' =>'required',
            'email' =>['required',Rule::unique('users','email'),Rule::unique('patients','email')],
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
    }


    public function destroy(){

    }

    public function edit(){

    }

    public function update(){

    }
}
