<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Patient;
class RegisterController extends Controller
{
    public function create(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'email' => ['required', 'email', Rule::unique('patients'), Rule::unique('users')],
        'phone' => 'required|min:9|max:10',
        'password' => 'required|min:6|max:30',
    ]);

    $data['password'] = bcrypt($data['password']);
    $patient = Patient::create($data);

    if (auth()->guard('patient')->attempt(['email' => $data['email'], 'password' => $request->input('password')])) {
        dd(auth()->guard('patient')->user());
        return redirect('/');
    } else {
        dd('failed');
        abort(404, 'Logging in has failed');
    }
}
}
