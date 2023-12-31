<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'user_id'=>User::factory(),
            'name'=>$this->faker->name(),
            'title'=>$this->faker->title(),
            'body'=>$this->faker->paragraph(2,true),
            'rating'=>5,
        ];
    }
}
