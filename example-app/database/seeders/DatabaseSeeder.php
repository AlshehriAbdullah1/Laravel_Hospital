<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Booking;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     
     
     * @return void
     */
    public function run()
    {
        $categories= Category::factory(10)->create();
        
        foreach ($categories as $category) {
            User::factory(10)->create([
                'category_id' => $category->id,
            ]);
        }
        $users= User::factory(10)->create();


        foreach($users as $user){
            Booking::factory(1)->create([
                'user_id' => $user->id, 
                
                ]
            );
        }
      

       
    }
}
