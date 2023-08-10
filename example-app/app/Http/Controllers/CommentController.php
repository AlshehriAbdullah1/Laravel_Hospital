<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
class CommentController extends Controller
{
    

    public function create(Request $request,$id){
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

    }
}
