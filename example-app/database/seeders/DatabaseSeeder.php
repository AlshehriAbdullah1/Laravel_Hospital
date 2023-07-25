<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
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
//         User::truncate();
//         Category::truncate();
//        Comment::truncate();

        $categories= Category::factory(10)->create();

        foreach ($categories as $category) {
            User::factory(10)->create([
                'category_id' => $category->id,
            ]);
        }


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
