<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's defaults state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'datetime_from' => date('Y-m-d H:i:s'),
            'datetime_to' => date('Y-m-d H:i:s', strtotime('+2 hours')),
            'status' => 'pending',
            'tracking_number'=>'123456',
            

        ];
    }
}
