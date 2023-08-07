<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $guarded= []; 
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
